<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('email');
        $password = $request->input('password');
        $type = $this->isEmail($username) == true ? 'email' : 'username';
        $credentials = [$type => $username, 'password' => $password];

        if (Auth::validate($credentials)) {
            $user = User::where($type, $username)->first();
            $data = [
                'user' => new UserResource($user),
                'token_type' => 'Bearer',
                'token' => $user->createToken('authToken')->plainTextToken
            ];
        } else {
            return response('Login Failed', Response::HTTP_UNAUTHORIZED);
        }

        return response($data, Response::HTTP_OK);
    }

    public function isEmail($email)
    {
        return (preg_match("/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/", $email) || !preg_match("/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $email)) ? false : true;
    }
}
