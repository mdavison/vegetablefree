<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
        'App\Events\RecipeWasDeleted' => [
            'App\Listeners\DeletePhotos',
            'App\Listeners\DeleteIngredients',
        ],
        'App\Events\UserWasDeleted' => [
            'App\Listeners\DeleteRecipes',
            'App\Listeners\EmailUserAccountDeleted',
        ],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
