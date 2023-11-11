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
        if (!isset($request->orderBy)) {
            $request->orderBy = 'id';
        }
        if (!isset($request->paginate)) {
            $request->paginate = '10';
        }
        if (!isset($request->page)) {
            $request->page = '1';
        }

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

        return redirect('/?paginate=10&page=1&orderBy=attendances.created_at')->with('status', [
            'type' => 'success',
            'text' => 'User logged in successfully!'
        ]);
    }

    public function logout(Request $request)
    {
        Session::forget('token');
        Session::flush();
        Auth::logout();

        return redirect('/login')->with('status', [
            'type' => 'success',
            'text' => 'User logged out successfully!'
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!isset($request->orderBy)) {
            $request->orderBy = 'id';
        }
        if (!isset($request->paginate)) {
            $request->paginate = '10';
        }
        if (!isset($request->page)) {
            $request->page = '1';
        }
        if (!isset($request->searchVal)) {
            $request->searchVal = '';
        }

        $user = User::find($id);

        if ($user == Null) {
            return redirect('/users?page=1&paginate=10&orderBy=conf_id')->with('status', [
                'type' => 'fail',
                'text' => 'user record update failed! user not found.'
            ]);
        }

        $input = $request->all();
        $user->fill($input)->save();

        return redirect('/users?page='.$request->page.'&paginate='.$request->paginate.'&orderBy='.$request->orderBy.'&searchVal='.$request->searchVal)->with('status', [
            'type' => 'success',
            'text' => 'user record updated successfully!'
        ]);
    }

    public function pwreset(Request $request, $id)
    {
        if (!isset($request->orderBy)) {
            $request->orderBy = 'id';
        }
        if (!isset($request->paginate)) {
            $request->paginate = '10';
        }
        if (!isset($request->page)) {
            $request->page = '1';
        }
        if (!isset($request->searchVal)) {
            $request->searchVal = '';
        }

        $user = User::find($id);

        if ($user == Null) {
            return redirect('/users?page=1&paginate=10&orderBy=id')->with('status', [
                'type' => 'fail',
                'text' => 'user password change failed! user not found.'
            ]);
        }

        $user->password = Hash::make('admin123!');
        $user->save();

        return redirect('/users?page='.$request->page.'&paginate='.$request->paginate.'&orderBy='.$request->orderBy.'&searchVal='.$request->searchVal)->with('status', [
            'type' => 'success',
            'text' => 'user password changed successfully!'
        ]);
    }
}
