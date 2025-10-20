<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
     public function create(User $user)
    {

        
        return $user->is_admin === 1;
    }
}
