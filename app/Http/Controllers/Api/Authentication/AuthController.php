<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function login(UserLoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $ability = (Auth::user()->is_admin) ? ['is_admin'] : ['is_user'];

            $token = $request->user()->createToken($request->email, $ability)->plainTextToken;

            $user = User::find(Auth::user()->id);

            return UserResource::make($user)->additional(['token' => $token]);
        } else {
            $response = ["message" => "Invalid Username & Password"];
            return response(json_encode($response), 401)->header('Content-Type', 'application/json');
        }
    }



    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();
        return response('', 204)->header('Content-Type', 'application/json');
    }
}
