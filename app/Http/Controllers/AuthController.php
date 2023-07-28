<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:user,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $response = 'User registered';

        // return response($response, 201);
        return redirect('/users')->with('status', [
            'type' => 'success',
            'text' => 'User record created successfully!'
        ]);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return redirect('/login')->with('status', [
                'type' => 'fail',
                'text' => 'Bad Credentials. Please try again.',
            ]);
        }
        else{
            $token = $user->createToken('kbtc_oid')->plainTextToken;
            Session::put('token', $token);
        }

        return redirect('/')->with('status', [
            'type' => 'success',
            'text' => 'User logged in successfully!'
        ]);
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();

        return redirect('/login')->with('status', [
            'type' => 'success',
            'text' => 'User logged out successfully!'
        ]);
    }
}
