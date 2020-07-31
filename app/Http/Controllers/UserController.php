<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllAdmins(Request $request)
    {
        return User::where('is_admin', 1)->get();
    }
}
