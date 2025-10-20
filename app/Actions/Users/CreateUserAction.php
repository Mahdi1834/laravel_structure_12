<?php

namespace App\Actions\Users;

use App\Events\UserRegistered;
use App\Jobs\NotifyAdminOfNewUser;
use App\Jobs\SendVerifactionEmailJob;
use App\Jobs\UpdateMonthlyReport;
use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Arr;
use App\Models\MonthlyReport;
use Illuminate\Support\Facades\Notification;


class CreateUserAction
{
    public function execute(array $userData, array $roles = [],)
    {
        $user = User::create(Arr::except($userData, ['roles']));
        $user->roles()->sync($roles);
        UserRegistered::dispatch($user);
        return $user;
    }
}
