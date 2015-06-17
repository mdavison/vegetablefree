<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipesController extends Controller {

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$recipes = Recipe::with('user')->get();

        return view('admin.recipes.index', compact('recipes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $photos_token = time();

        return view('admin.recipes.create', compact('photos_token'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $this->validate($request, Recipe::$rules);

        $recipe = (new Recipe())->createRecipe($request, 1);

        return redirect('admin/recipes')->withMessage('Recipe ' . $recipe->title . ' was created.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $recipe = Recipe::with('photos')->findOrFail($id);

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
        $recipe = Recipe::with('ingredients')->findOrFail($id);
        $photos_token = time();

        return view('admin.recipes.edit', compact('recipe', 'photos_token'));
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

        return redirect('admin/recipes')->withMessage('Recipe was updated.');
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

        return redirect('admin/recipes')->withMessage('Recipe '. $recipe->title . ' was deleted.');
	}

    public function approve(Request $request)
    {
        $recipe = Recipe::findOrFail($request->get('id'));
        // Toggle approval
        $setApproval = '';
        if ($recipe->is_approved) {
            $recipe->is_approved = 0;
            $setApproval = 'unapproved';
        } else {
            $recipe->is_approved = 1;
            $setApproval = 'approved';
        }
        //$recipe->is_approved = 1;
        if ( ! $recipe->update()) {
            return 'false';
        }

        // Bulk-approval - not using at this time
        /*$ids = $request->get('ids');
        foreach ($ids as $id) {
            $recipe = Recipe::findOrFail($id);
            $recipe->is_approved = 1;
            if ( ! $recipe->update()) {
                return 'false';
            }
        }*/

        return $setApproval;
    }

    public function photos(Request $request)
    {
        $recipe = Recipe::with('photos')->findOrFail($request->get('id'));

        return $recipe->photos;
    }

}
