<?php

namespace App\Repositories;

use App\User;
use Illuminate\Http\Request;

class UserRepository
{
    public function create(Request $request): User
    {
        return User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);
    }
}
