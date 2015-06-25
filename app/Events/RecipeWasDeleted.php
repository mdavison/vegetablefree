<?php

namespace App\Events;

use App\Events\Event;
use App\Recipe;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RecipeWasDeleted extends Event
{
    use SerializesModels;

    public $recipe;

    /**
     * Create a new event instance.
     *
     * @param  Recipe  $recipe
     * @return void
     */
    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
