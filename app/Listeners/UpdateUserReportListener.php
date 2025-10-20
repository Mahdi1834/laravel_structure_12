<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Jobs\UpdateMonthlyReport;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUserReportListener implements ShouldQueue
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
                UpdateMonthlyReport::dispatch();

    }
}
