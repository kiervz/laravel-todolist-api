<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;

use Auth;

class UserController extends Controller
{
    public function me()
    {
        return response(['data' => new UserResource(Auth::user())]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response(['message' => 'successfully logged out!']);
    }
}
