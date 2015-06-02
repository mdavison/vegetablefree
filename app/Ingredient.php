<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'quantity', 'measurement', 'recipe_id'];

    public static $rules = [
        'name' => 'max:255'
    ];

    public function recipe()
    {
        return $this->belongsTo('\App\Recipe');
    }

}
