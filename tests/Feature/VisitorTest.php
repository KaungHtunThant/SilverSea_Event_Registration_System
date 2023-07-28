<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Session;
use App\Models\Visitor;
use App\Http\Controllers\TestPreparer;

class VisitorTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @return void
     *
    **/

    public function test_create_visitor_record(): void
    {
        $user = new TestPreparer;
        $user->createAdmin();

        $response = $this->post('/login', [
            'email' => 'admin@email.com',
            'password' => 'admin123!',
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . Session::get('token'))->post('/visitors', [
            'name' => 'doe',
            'email' => 'doe@gmail.com',
            'phone' => '09876543210',
            'dob' => '12/12/2023',
            'sex' => 'Male',
            'company' => 'Silver Sea'
        ]);

        $response->assertSessionHas('status.type', 'success');
    }

    public function test_update_visitor_record(): void
    {
        $user = new TestPreparer;
        $user->createAdmin();

        $response = $this->post('/login', [
            'email' => 'admin@email.com',
            'password' => 'admin123!',
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . Session::get('token'))->post('/visitors', [
            'name' => 'doe',
            'email' => 'doe@gmail.com',
            'phone' => '09876543210',
            'dob' => '12/12/2023',
            'sex' => 'Male',
            'company' => 'Silver Sea'
        ]);

        $user = Visitor::latest('id')->first();
        $response = $this->withHeader('Authorization', 'Bearer ' . Session::get('token'))->patch('/visitors/'.$user->id, [
            'name' => 'john',
            'email' => 'john@gmail.com',
            'phone' => '09875643210',
            'dob' => '12/12/2012',
            'sex' => 'Female',
            'company' => 'Silver Sea Co., Ltd'
        ]);

        $response->assertSessionHas('status.type', 'success');
    }

    public function test_fail_to_update_visitor_record(): void
    {
        $user = new TestPreparer;
        $user->createAdmin();

        $response = $this->post('/login', [
            'email' => 'admin@email.com',
            'password' => 'admin123!',
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . Session::get('token'))->patch('/visitors/100', [
            'name' => 'john',
            'email' => 'john@gmail.com',
            'phone' => '09875643210',
            'dob' => '12/12/2012',
            'sex' => 'Female',
            'company' => 'Silver Sea Co., Ltd'
        ]);

        $response->assertSessionHas('status.type', 'fail');
    }

    public function test_delete_visitor_record(): void
    {
        $user = new TestPreparer;
        $user->createAdmin();

        $response = $this->post('/login', [
            'email' => 'admin@email.com',
            'password' => 'admin123!',
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . Session::get('token'))->post('/visitors', [
            'name' => 'doe',
            'email' => 'doe@gmail.com',
            'phone' => '09876543210',
            'dob' => '12/12/2023',
            'sex' => 'Male',
            'company' => 'Silver Sea'
        ]);

        $user = Visitor::latest('id')->first();
        $response = $this->withHeader('Authorization', 'Bearer ' . Session::get('token'))->delete('/visitors/'.$user->id);

        $response->assertSessionHas('status.type', 'success');
    }
}