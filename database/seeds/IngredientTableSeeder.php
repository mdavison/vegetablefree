<?php

use App\Ingredient;
use Illuminate\Database\Seeder;

class IngredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('ingredients')->truncate();

        Ingredient::create([
            'id'        => 1,
            'name'      => '1 1/2 to 2 lbs ground beef',
            'recipe_id' => 1
        ]);
        Ingredient::create([
            'id'        => 2,
            'name'      => '1 tbsp onion powder',
            'recipe_id' => 1
        ]);
        Ingredient::create([
            'id'        => 3,
            'name'      => '1 large can tomato puree',
            'recipe_id' => 1
        ]);
        Ingredient::create([
            'id'        => 4,
            'name'      => '1 small can tomato paste',
            'recipe_id' => 1
        ]);
        Ingredient::create([
            'id'        => 5,
            'name'      => '4 tbsp chili powder',
            'recipe_id' => 1
        ]);
        Ingredient::create([
            'id'        => 6,
            'name'      => '2 cloves garlic (or 1/4 tsp garlic powder)',
            'recipe_id' => 1
        ]);
        Ingredient::create([
            'id'        => 7,
            'name'      => '1 tsp black pepper',
            'recipe_id' => 1
        ]);
        Ingredient::create([
            'id'        => 8,
            'name'      => '2 cans dark red kidney beans',
            'recipe_id' => 1
        ]);

        Ingredient::create([
            'id'        => 9,
            'name'      => '1/2 cup sugar',
            'recipe_id' => 2
        ]);
        Ingredient::create([
            'id'        => 10,
            'name'      => '1/2 cup unsweetened cocoa powder',
            'recipe_id' => 2
        ]);
        Ingredient::create([
            'id'        => 11,
            'name'      => '1/4 tsp salt',
            'recipe_id' => 2
        ]);
        Ingredient::create([
            'id'        => 12,
            'name'      => '3 tbsp cornstarch',
            'recipe_id' => 2
        ]);
        Ingredient::create([
            'id'        => 13,
            'name'      => '1 cup milk',
            'recipe_id' => 2
        ]);
        Ingredient::create([
            'id'        => 14,
            'name'      => '1 cup cream',
            'recipe_id' => 2
        ]);
        Ingredient::create([
            'id'        => 15,
            'name'      => '1 tsp vanilla extract',
            'recipe_id' => 2
        ]);

        Ingredient::create([
            'id'        => 16,
            'name'      => '10 large eggs',
            'recipe_id' => 3
        ]);

        Ingredient::create([
            'id'        => 17,
            'name'      => '4 cups chicken broth, divided (use one containing MSG if you can - it will taste much better)',
            'recipe_id' => 4
        ]);
        Ingredient::create([
            'id'        => 18,
            'name'      => '1/8 teaspoon ground ginger',
            'recipe_id' => 4
        ]);
        Ingredient::create([
            'id'        => 19,
            'name'      => '1 1/2 tablespoons cornstarch',
            'recipe_id' => 4
        ]);
        Ingredient::create([
            'id'        => 20,
            'name'      => '2 eggs',
            'recipe_id' => 4
        ]);
        Ingredient::create([
            'id'        => 21,
            'name'      => '1 egg yolk',
            'recipe_id' => 4
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
