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
        return (new Photo)->uploadPhoto($request);
	}

    /**
     * Remove a photo from the filesystem
     *
     * @param Request $request
     * @return mixed
     */
    public function remove(Request $request)
    {
        return (new Photo)->removePhoto($request);
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
