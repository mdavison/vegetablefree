<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Recipe;

class RecipeTableSeeder extends Seeder{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('recipes')->truncate();

        Recipe::create([
            'id'            => 1,
            'title'         => 'Chili',
            'slug'          => 'chili',
            'description'   => 'No chunks of tomatoes or onions!',
            'directions'    => "1. Brown ground beef until no longer pink. Drain and return to stove.
                                2. Add garlic cloves to beef and cook until fragrant, about 20-30 seconds.
                                3. Mix everything together into crockpot and cook on low for 6-8 hours.",
            'user_id'       => 1,
            'is_approved'   => 1
        ]);

        Recipe::create([
            'id'            => 2,
            'title'         => 'Chocolate Pudding',
            'slug'          => 'chocolate-pudding',
            'description'   => 'Simple but rich!',
            'directions'    => "1. Heat the milk and cream in saucepan over medium heat until bubbles form around the edges
                                2. Mix the sugar, cocoa powder, salt, and cornstarch together in a small bowl.
                                3. Take 1/2 cup of the liquid and whisk rapidly into the dry ingredients. Then add everything back into the pan.
                                4. Cook over medium-low heat, whisking constantly, until thick and boiling.
                                5. Stir in vanilla.",
            'user_id'       => 1,
            'is_approved'   => 1
        ]);

        Recipe::create([
            'id'            => 3,
            'title'         => 'Medium Boiled Eggs',
            'slug'          => 'medium-boiled-eggs',
            'description'   => 'Not runny but not hard. You might have to experiment with the time to get them perfect. This is what works on my stove with my pan.',
            'directions'    => "1. Place the eggs in a medium saucepan. Add enough water to just cover the eggs. Put the pan on the stove and cook over high heat for 12 minutes.
                                2. Meanwhile, prepare a large bowl of ice water.
                                3. When the timer goes off, immediately remove the pan from the stove, drain the cooking water and dump the eggs into the ice water. Let sit for 30 seconds before peeling.
                                4. To peel, smash egg all over and on large end. Starting on large end, peel shell, making sure to get under the \"skin\". The shell should come off in almost one piece.",
            'user_id'       => 2,
            'is_approved'   => 1
        ]);

        Recipe::create([
            'id'            => 4,
            'title'         => 'Egg Drop Soup',
            'slug'          => 'egg-drop-soup',
            'description'   => 'So easy!',
            'directions'    => "1. Reserve 3/4 cup of chicken broth.
                                2. Pour the rest into a saucepan, add the ginger, and bring to a rolling boil.
                                3. In a cup or small bowl, stir together the remaining broth and cornstarch until smooth. Set aside.
                                4. In a small bowl, whisk the eggs and egg yolk together using a fork. Drizzle egg a little at a time from the fork into the boiling broth mixture. Egg should cook immediately.
                                5. Stir in the cornstarch mixture gradually until the soup is the desired consistency.",
            'user_id'       => 2
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}