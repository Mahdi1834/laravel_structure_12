<?php

namespace App\Listeners;

use App\Models\Project;
use App\Models\Category;
use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDefaultUserDataListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;

        Project::create([
            'user_id' => $user->id,
            'name' => 'Demo project 1',
        ]);

        Category::create([
            'user_id' => $user->id,
            'name' => 'Demo category 2',
        ]);
    }
}
