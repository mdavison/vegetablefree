<?php namespace App\Http\Controllers;

use App\Recipe;

class PagesController extends Controller {


    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function home()
    {
        // get all recipes limit 10
        $recipes = Recipe::with('photos')->where('is_approved', '=', 1)->orderBy('id', 'desc')->take(10)->get();

        return view('home', compact('recipes'));
    }

}
