<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\TestPreparer;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @return void
     *
    **/

    public function test_register_submit(): void
    {
        $user = new TestPreparer;
        $user->createAdmin();

        $response = $this->post('/login', [
            'email' => 'admin@email.com',
            'password' => 'admin123!',
        ]);

        $response = $this->post('/users', [
            'name' => 'John',
            'email' => 'john@mail.com',
            'password' => '123',
            'password_confirmation' => '123',
        ]);

        $response->assertSessionHas('status.type', 'success');
    }

    public function test_login_submit(): void
    {
        $user = new TestPreparer;
        $user->createAdmin();

        $response = $this->post('/login', [
            'email' => 'admin@email.com',
            'password' => 'admin123!',
        ]);

        $response->assertSessionHas('status.type', 'success');
    }

    public function test_logout(): void
    {
        $user = new TestPreparer;
        $user->createAdmin();

        $response = $this->post('/login', [
            'email' => 'admin@email.com',
            'password' => 'admin123!',
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . Session::get('token'))->get('/logout');

        $response->assertSessionHas('status.type', 'success');
    }
}
