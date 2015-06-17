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

            // Create the temporary location
            $filepath = storage_path() . "/app/photos/{$token}";
            if ( ! file_exists($filepath)) {
                if ( ! mkdir($filepath, 0777, true)) {
                    return Response::json('Unable to create file path.', 400);
                }
            }

            // Check if photo with same name already exists
            if ( ! empty($recipe_id) && file_exists(public_path() . "/photos/{$recipe_id}/{$filename}")) {
                return Response::json('Photo with same name already exists.', 400);
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

}
