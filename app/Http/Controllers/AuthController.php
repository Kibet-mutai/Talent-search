<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
    /**
     * Register User
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Signup(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users|email',
            'password' => 'required|between:8,255|confirmed'
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createtoken('apitoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
    

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * Log out user
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logout successfully!'
        ];
    }

    /**
     * Login User
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function sign_in(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        //confirm email

        $user = User::where('email', $data['email'])->first();

        //confirm password

        if(!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'Invalid email or password'
            ], 401);
        }
        $token = $user->createToken('apitoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
