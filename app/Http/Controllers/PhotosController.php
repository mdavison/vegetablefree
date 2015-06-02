<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Response;
use Intervention\Image\Facades\Image;

class PhotosController extends Controller {

		/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $token = $request->get('photos_token');
        $file = $request->file('file');

        if($file) {
            $filename = time() . '-' . $file->getClientOriginalName();
            $filesize = $file->getClientSize();
            $filetype = $file->getMimeType();
            if ( ! $filesize > 0) {
                return ['error' => 'Photo is too large'];
            }
            // Create the temporary location
            $filepath = storage_path() . "/app/photos/{$token}";

            if ( ! file_exists($filepath)) {
                if ( ! mkdir($filepath, 0777, true)) {
                    return ['error' => 'Unable to create file path.'];
                }
            }

            // Crop	& save with Intervention Image
            $image = Image::make($file);
            $image->fit(200, 150, function($constraint){
                $constraint->upsize();
            })->save("{$filepath}/{$filename}");

            return Response::json('success', 200);
        }

        return Response::json('error', 400);
	}

    /**
     * CURRENTLY NOT USING - see note in dropzone.blade.php
     * Takes an ajax request from the create recipe page
     * to remove a photo from the UI
     *
     * @param Request $request
     * @return mixed
     */
    public function remove(Request $request)
    {
        $filepath = storage_path() . "/app/photos/{$request->get('photos_token')}/*";
        $filename = $request->get('filename');

        foreach(glob($filepath) as $file) {
            if( ! is_dir($file)) {
                $basename = explode('-', basename($file), 2)[1];
                if ($basename === $filename) {
                    unlink($file);
                }
            }
        }

        return Response::json('success', 200);
    }

}
