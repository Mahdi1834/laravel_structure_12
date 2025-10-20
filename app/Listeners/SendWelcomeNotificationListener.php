<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Jobs\SendVerifactionEmailJob;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeNotificationListener implements ShouldQueue
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
              SendVerifactionEmailJob::dispatch($event->user);

    }
}
