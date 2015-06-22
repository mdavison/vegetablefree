<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Response;

class Photo extends Model {

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['filename', 'type', 'size', 'recipe_id'];

    /**
     * Enable soft deletes
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Set maximum number of photos per recipe
     *
     * @var int
     */
    protected $maxPhotos = 5;

    /**
     * A photo belongs to a recipe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo('App\Recipe');
    }

    /**
     * Uploads photo to temp directory
     *
     * @param Request $request
     * @return mixed
     */
    public function uploadPhoto(Request $request)
    {
        $token = $request->get('photos_token');
        $file = $request->file('file');
        $recipe_id = $request->get('recipe_id');

        if($file) {
            $filename = $file->getClientOriginalName();
            $filesize = $file->getClientSize();
            if ( ! $filesize > 0) {
                return Response::json('Photo is too large.', 400);
            }

            $filepath = storage_path() . "/app/photos/{$token}";

            // Check if allowed to upload any more
            if ($recipe_id) {
                $photoLimitReached = $this->maxPhotosLimitReached($filepath . "/*", public_path() . "/photos/{$recipe_id}/*");
            } else {
                $photoLimitReached = $this->maxPhotosLimitReached($filepath . "/*");
            }
            if ($photoLimitReached) {
                return Response::json('Sorry! Too many photos.', 400);
            }

            // Check if photo with same name already exists in temp dir
            if (file_exists($filepath . "/{$filename}")) {
                return Response::json('Photo with same name already exists.', 400);
            }
            // Check if photo with same name already exists in public dir
            if ( (! empty($recipe_id)) && file_exists(public_path() . "/photos/{$recipe_id}/{$filename}")) {
                return Response::json('Photo with same name already exists.', 400);
            }

            // Create the temporary location
            if ( ! file_exists($filepath)) {
                if ( ! mkdir($filepath, 0777, true)) {
                    return Response::json('Unable to create file path.', 400);
                }
            }

            // Crop	& save with Intervention Image
            $image = Image::make($file);
            $image->fit(200, 150, function($constraint){
                $constraint->upsize();
            })->save("{$filepath}/{$filename}");

            return Response::json('Success', 200);
        }

        return Response::json('Error', 400);
    }

    /**
     * Remove a photo from the filesystem from a Request
     *
     * @param Request $request
     * @return mixed
     */
    public function removePhoto(Request $request)
    {
        return $this->deletePhoto(
            $request->get('filename'),
            $request->get('id'),
            $request->get('photos_token')
        );
    }

    public function removePhotosForRecipe($recipe_id)
    {
        $photos = self::where('recipe_id', '=', $recipe_id)->get();

        if (count($photos)) {
            foreach ($photos as $photo) {
                $this->deletePhoto($photo->filename, $recipe_id);
            }
        }

        return true;
    }

    /**
     * Get photo from filename and recipe id
     *
     * @param $filename
     * @param $recipe_id
     * @return collection
     */
    private function getPhotoFromName($filename, $recipe_id)
    {
        return self::where(['filename' => $filename, 'recipe_id' => $recipe_id])->first();
    }

    /**
     * Delete photo from filepath and db
     *
     * @param $photos_token
     * @param $filename
     * @param $recipe_id
     * @return mixed
     */
    private function deletePhoto($filename, $recipe_id, $photos_token = null)
    {
        // If $photos_token set, delete from temp storage
        if ($photos_token) {
            $filepath = storage_path() . "/app/photos/{$photos_token}/*";

            foreach(glob($filepath) as $file) {
                if( ( ! is_dir($file)) && basename($file) === $filename) {
                    // Delete photo
                    unlink($file);

                    // Delete empty directory
                    $dir = storage_path() . "/app/photos/{$photos_token}";
                    if(is_dir($dir) && count(glob($filepath)) === 0) {
                        rmdir($dir);
                    }

                    return Response::json('success', 200);
                }
            }
        }

        // Delete from public
        $filepath = public_path() . "/photos/{$recipe_id}/*";

        foreach(glob($filepath) as $file) {
            if( ( ! is_dir($file)) && basename($file) === $filename) {
                // Delete photo
                unlink($file);

                // Delete from db
                $photo = $this->getPhotoFromName($filename, $recipe_id);
                $photo->delete();

                // Delete empty directory
                $dir = public_path() . "/photos/{$recipe_id}";
                if(is_dir($dir) && count(glob($filepath)) === 0) {
                    rmdir($dir);
                }

                return Response::json('success', 200);
            }
        }

        return Response::json('success', 200);
    }

    private function maxPhotosLimitReached($temp_dir, $public_dir = null)
    {
        $temp_dir_count = count(glob($temp_dir));

        if ($public_dir) {
            $public_dir_count = count(glob($public_dir));
        } else {
            $public_dir_count = 0;
        }


        if (($temp_dir_count + $public_dir_count) < $this->maxPhotos) {
            return false;
        }

        return true;
    }
}
