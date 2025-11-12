<?php

namespace App\Service\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
     public function __construct()
    {
    }

    public function registerUser($data)
    {
        $rejectUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'confirm_password' => Hash::make($data['confirm_password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);
    }


}
