<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminNewUserNotification;

class NotifyAdminOfNewUser implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $newUser)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
          $admins = User::where('is_admin', 1)->get();
        if ($admins->isNotEmpty()) {
            Notification::send($admins, new AdminNewUserNotification($this->newUser));
        }
    }
}
