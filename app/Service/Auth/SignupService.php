<?php

namespace App\Service\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignupService
{
    function create($request)
    {
        $data = $request->only(['name', 'password', 'email']);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        return $user;
    }

}
