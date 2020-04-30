<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Role;
use Auth;

class PassportController extends Controller
{
    public function register(Request $request)
    {
        //validates inputted data
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|regex:/^[a-zA-Z ]+$/',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        //return error response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        //attact user to 'user' role
        $user->roles()->attach(Role::where('name','user')->first());

        //create user token
        $token = $user->createToken('iWander')->accessToken;

        //return data
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'token' => $token
        ], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6',
        ]);

        //if log in attempt fail
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('iWander')->accessToken;


            // Auth::guard('web')->login($user);

            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token
            ], 200);
        }
        else {
            return response()->json(['message'=> 'Unauthorised' , 'errors' => 'Unauthorised'], 401);
        }
    }

    public function user()
    {
        return response()->json(['user' => auth()->user()], 200);
    }

    public function logout(Request $request)
    {

        $request->user()->token()->revoke();
        //logs user out of the web too
        Auth::guard('web')->logout();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
