<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllUsers()
    {
        return $this->user->latest('id');
    }
}
