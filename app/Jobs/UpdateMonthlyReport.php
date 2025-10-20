<?php

namespace App\Jobs;

use App\Models\MonthlyReport;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateMonthlyReport implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
                 MonthlyReport::where('month', now()->format('Y-m'))->increment('users_count');

    }
}
