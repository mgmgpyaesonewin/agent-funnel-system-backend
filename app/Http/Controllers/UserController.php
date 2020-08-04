<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllAdmins(Request $request)
    {
        return User::where('is_admin', 1)->get();
    }

    public function users()
    {
        $users = User::all();

        return UserResource::collection($users);
    }
}
