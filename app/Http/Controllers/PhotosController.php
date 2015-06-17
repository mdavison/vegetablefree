<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Photo;
use Illuminate\Http\Request;
use Response;

class PhotosController extends Controller {

		/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $photo = new Photo();

        return $photo->uploadPhoto($request);
	}

    /**
     * Takes an ajax request to remove a photo from the UI
     * on create or edit recipe pages
     *
     * @param Request $request
     * @return mixed
     */
    public function remove(Request $request)
    {
        // First, try the storage path - we would be creating a new recipe
        $filepath = storage_path() . "/app/photos/{$request->get('photos_token')}/*";
        $filename = $request->get('filename');

        foreach(glob($filepath) as $file) {
            if( ( ! is_dir($file)) && basename($file) === $filename) {
                unlink($file);

                return Response::json('success', 200);
            }
        }

        // Then, try the public path - we would be editing existing recipe
        $filepath = public_path() . "/photos/{$request->get('id')}/*";

        // Delete from db
        //$photo = $this->getPhotoFromName($filename, $request->get('id'));
        //$this->destroy($photo->id);

        foreach(glob($filepath) as $file) {
            if( ( ! is_dir($file)) && basename($file) === $filename) {
                // Delete photo
                unlink($file);

                // Delete from db
                $photo = $this->getPhotoFromName($filename, $request->get('id'));
                $this->destroy($photo->id);

                // Just delete one and then return out of loop -
                // BUT, it ends up deleting all photos from file system with same name
                // but correctly deletes only one from db - can't figure it out
                return Response::json('success', 200);
            }
        }

        return Response::json('success', 200);
    }

    /**
     * Get photo from filename and recipe id
     *
     * @param $filename
     * @param $recipe_id
     * @return collection
     */
    public function getPhotoFromName($filename, $recipe_id)
    {
        return Photo::where(['filename' => $filename, 'recipe_id' => $recipe_id])->first();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();

        return true;
    }
}
