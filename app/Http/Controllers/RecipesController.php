<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RecipesController extends Controller {

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        //$this->middleware('admin', ['only' => ['edit', 'update', 'destroy']]);
        $this->middleware('owner', ['only' => ['edit', 'update', 'destroy']]);
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$recipes = Recipe::where('is_approved', '=', 1)->with('user')->get();

        return view('recipes.index', compact('recipes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $photos_token = time();

        return view('recipes.create', compact('photos_token'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $this->validate($request, Recipe::$rules);

        $recipe = (new Recipe())->createRecipe($request);

        $message = 'Recipe ' .
                   $recipe->title .
                   ' was created. As soon as it is approved, you will be able to view it on the website.';

        return redirect('recipes')->withMessage($message);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        // Is $id a slug?
        if ( ! count($recipe = Recipe::where('slug', '=', $id)->first())) {
            $recipe = Recipe::findOrFail($id);
        }

        // Not allowed to view if not approved
        if ($recipe->is_approved == false) {
            return redirect('recipes');
        }

        return view('recipes.show', compact('recipe'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        // Is $id a slug?
        if ( ! $recipe = Recipe::where('slug', '=', $id)->get()) {
            $recipe = Recipe::findOrFail($id);
        }

        return view('recipes.edit', compact('recipe'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $this->validate($request, Recipe::$rules);

        $recipe = Recipe::findOrFail($id);
        $recipe->editRecipe($request);

        return redirect('recipes')->withMessage('Recipe was updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();

        return redirect('recipes')->withMessage('Recipe '. $recipe->title . ' was deleted.');
	}

}
