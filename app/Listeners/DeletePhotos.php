<?php

namespace App\Listeners;

use App\Photo;
use App\Events\RecipeWasDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeletePhotos
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
        (new Photo())->removePhotosForRecipe($event->recipe->id);
    }
}
