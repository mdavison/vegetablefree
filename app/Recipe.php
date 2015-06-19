<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class Recipe extends Model {

	use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'directions'];

    /**
     * Enable soft deletes
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
    'title' => 'required|max:40',
    'directions' => 'required'
];

    /**
     * A recipe belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    /**
     * A recipe has many ingredients
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ingredients()
    {
        return $this->hasMany('\App\Ingredient');
    }

    /**
     * A recipe has many photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('\App\Photo');
    }

    /**
     * Generate a unique slug for a recipe
     *
     * @param $title
     * @return string
     */
    public function getUniqueSlug($title)
    {
        $slug = str_slug($title);
        $count = $this::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    /**
     * Create a new recipe
     *
     * @param Request $request
     * @param int $approved
     * @return $this
     */
    public function createRecipe(Request $request, $approved = 0)
    {
        $this->title = $request->get('title');
        $this->slug = $this->getUniqueSlug($request->get('title'));
        $this->description = $request->get('description');
        $this->directions = $request->get('directions');
        $this->user_id = Auth::user()->id;
        $this->is_approved = $approved;

        return $this->saveRecipe($request);
    }

    /**
     * Edit an existing recipe
     *
     * @param Request $request
     * @return $this
     */
    public function editRecipe(Request $request)
    {
        $this->title = $request->get('title');
        $this->slug = $this->getUniqueSlug($request->get('title'));
        $this->description = $request->get('description');
        $this->directions = $request->get('directions');

        return $this->saveRecipe($request);
    }

    /**
     * Save a recipe
     *
     * @param Request $request
     * @return $this
     */
    private function saveRecipe(Request $request)
    {
        $this->save();

        // Save the ingredients
        $this->saveIngredients($request->get('ingredients'));

        // Save the photos
        $this->savePhotos($request->get('photos_token'));

        return $this;
    }

    /**
     * Save ingredients for new or edited recipe
     *
     * @param array $ingredients
     */
    private function saveIngredients($ingredients)
    {
        // Get existing ingredients for recipe, if any
        if (count($this->ingredients)) {
            $oldIngredients = [];
            foreach ($this->ingredients as $ingredient) {
                $oldIngredients[] = $ingredient->id;
            }
        }

        // Save new ingredients
        foreach ($ingredients as $ingredient) {
            if( ! empty($ingredient)) {
                Ingredient::create([
                    'name' => $ingredient,
                    'recipe_id' => $this->id
                ]);
            }
        }

        // Delete all old ingredients for recipe
        if (!empty($oldIngredients)) {
            Ingredient::destroy($oldIngredients);
        }
    }


    private function savePhotos($token)
    {
        // Get the temp directory for photos
        $dir = storage_path() . "/app/photos/{$token}/*";

        // Permanent location
        $new_dir = public_path() . "/photos/{$this->id}/";
        if ( ! file_exists($new_dir)) {
            if ( ! mkdir($new_dir, 0777, true)) {
                return ['error' => 'Unable to create file path.'];
            }
        }

        // Loop through all photos in directory and save to db
        foreach(glob($dir) as $file) {
            if( ! is_dir($file)) {
                Photo::create([
                    'filename' => basename($file),
                    'recipe_id' => $this->id
                ]);

                // Move the photos to the public directory
                rename($file, $new_dir . basename($file));
            }
        }

        // Delete the temp directory
        $temp_dir = storage_path() . "/app/photos/{$token}"; // $dir path without *
        // Check that directory exists and it is empty
        if(is_dir($temp_dir) && count(glob($dir)) === 0) {
            rmdir($temp_dir);
        }
    }

    public function destroyRecipe($id)
    {
        $recipe = self::findOrFail($id);
        $recipe->delete();

        $photo = new Photo();
        $photo->removePhotosForRecipe($id);

        return $recipe;
    }

}
