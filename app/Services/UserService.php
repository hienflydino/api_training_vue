<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

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

    public function createUser($request)
    {
        try {
            $this->user->create($request->all());

            return true;
        } catch (Exception $e) {
            Log::error($e);
        
            return false;
        }
    }

    public function updateUser($request, $user)
    {
        try {
            $user->update($request->all());

            return true;
        } catch (Exception $e) {
            Log::error($e);
        
            return false;
        }
    }

    public function deleteUser($user)
    {
        try {
            $user->delete();

            return true;
        } catch (Exception $e) {
            Log::error($e);
        
            return false;
        }
    }
}
