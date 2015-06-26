<?php

namespace App\Listeners;

use App\Events\UserWasDeleted;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailUserAccountDeleted
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
     * @param  UserWasDeleted  $event
     * @return void
     */
    public function handle(UserWasDeleted $event)
    {
        (new User())->sendEmailDeletedAccount($event->user->id);
    }
}
