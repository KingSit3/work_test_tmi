<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TestPassportAuthController extends Controller
{
    public function Login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required|min:8",
        ]);

        $user = User::where("email", $request->email)->first();
        if (!$user) {
            return response(["message" => "Wrong email or password!"], 400);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response(["message" => "Wrong email or password!"], 400);
        }

        return response(["token" => $user->createToken("Token Access")->accessToken]);
    }

    public function Logout()
    {
        $user = Auth::user()->token()->revoke();
        return response(["token" => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8",
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $token = $user->createToken("Token access")->accessToken;
        return response(["token" => $token]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        // $user = User::find($id)->first();
        return response($user);
    }
}
