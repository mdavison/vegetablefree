<?php

namespace App\Listeners;

use App\Events\RecipeWasDeleted;
use App\Ingredient;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteIngredients
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RecipeWasDeleted  $event
     * @return void
     */
    public function handle(RecipeWasDeleted $event)
    {
        (new Ingredient())->removeIngredientsForRecipe($event->recipe->id);
    }
}
