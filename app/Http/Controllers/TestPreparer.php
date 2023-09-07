<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Attendance;

class TestPreparer extends Controller
{
    public function createAdmin()
    {
        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@emp.powerglobal.com.mm',
            'password' => 'emp321!', // password
        ]);

        return $user;
    }

    public function test(Request $request)
    {
        return "test";
    }

    public function createVisitors()
    {
        $visitors = Visitor::factory()->count(150)->create();

        return $visitors;
    }

    public function createAttendances()
    {
        $att = Attendance::factory()->count(10)->create();

        return $att;
    }

    // public function barcode(Request $request)
    // {
    //     return 
    // }
}
