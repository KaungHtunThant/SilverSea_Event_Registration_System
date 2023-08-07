<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if ($request->searchVal != '') {
            $users =  User::where('name', 'LIKE', '%'.$request->searchVal.'%')
            ->orwhere('email', 'LIKE', '%'.$request->searchVal.'%')
            ->orderBy($request->orderBy)
            ->paginate($request->paginate);
        }
        else{
            $users = User::orderBy($request->orderBy)->paginate($request->paginate);
        }
        $users->appends([
            'orderBy' => $request->orderBy,
            'searchVal' => $request->searchVal,
            'paginate' => $request->paginate
        ]);

        return view('admin.users.index')
            ->with('users', $users)
            ->with('page', $request->page)
            ->with('searchVal', $request->searchVal)
            ->with('orderBy', $request->orderBy)
            ->with('paginate', $request->paginate)
            ->with('status', [
                'type' => 'success',
                'text' => 'user view read.'
            ]);
    }

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

        return redirect('/users?orderBy=id&paginate=10&page=1')
            ->with('status', [
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

        return redirect('/?paginate=10&page=1&orderBy=att.created_at')->with('status', [
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
