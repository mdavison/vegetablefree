<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model {

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'quantity', 'measurement', 'recipe_id'];

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
        'name' => 'max:255'
    ];

    /**
     * An ingredient belongs to a recipe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo('\App\Recipe');
    }

    /**
     * Delete ingredients when a recipe is deleted
     *
     * @param $recipe_id
     * @return bool
     */
    public function removeIngredientsForRecipe($recipe_id)
    {
        $ingredients = self::where('recipe_id', '=', $recipe_id)->get();

        if (count($ingredients)) {
            foreach ($ingredients as $ingredient) {
                $ingredient->delete();
            }
        }

        return true;
    }

}
