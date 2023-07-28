<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Visitor;

class TestPreparer extends Controller
{
    public function createAdmin()
    {
        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@email.com',
            'password' => 'admin123!', // password
        ]);

        return $user;
    }

    public function test(Request $request)
    {
        return "test";
    }

    public function createVisitors()
    {
        $visitors = Visitor::factory()->count(10)->create();

        return $visitors;
    }

    // public function barcode(Request $request)
    // {
    //     return 
    // }
}
