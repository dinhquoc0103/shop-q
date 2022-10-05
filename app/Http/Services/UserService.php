<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserService
{
    // Insert user row
    public function insertUserRow($data)
    {
        try
        {
            User::create($data);
        }
        catch(Exception $error)
        {
            return false;
        }
        return true;
    }

    // Insert user row return user's id
    public function insertUserRowReturnId($data)
    {
        return User::create($data)->id;
    }

    // Get user by user's id
    public function getUserById($id)
    {
        return User::find($id);
    }

    public function getUserByEmail($email)
    {
        return User::where("email", $email)->first();
    }

    // Update user row
    public function updateUserRow($user, $data)
    {
        try{  
            $user->fill($data);
            $user->save();
        }
        catch(\Exception $error){
            Log::info($error->getMessage());
            return false;
        }

        return true;
    }

    // Get new users
    public function getNewUser($limit)
    {
        return User::where("active", 1)
            ->orderByDesc('id')
            ->offset(1)
            ->limit($limit)
            ->get();
    }

    

}