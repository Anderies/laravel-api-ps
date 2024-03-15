<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassportAuthController extends Controller
{
    //
    public function register(Request $request) {
        // validation
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return $this->sendResponse($user, "User has been registered!");
    }

    public function login(Request $request) {
        $data = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken("Personal Access Token")->accessToken;

            return $this->sendResponse($token, "Login success!");
        }
        else {
            return $this->sendError(null, "Login failed.");
        }
    }
}
