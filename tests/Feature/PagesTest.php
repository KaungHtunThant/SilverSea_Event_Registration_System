<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\TestPreparer;

class PagesTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @return void
     *
    **/

    public function test_login_page(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_dashboard(): void
    {
        $user = new TestPreparer;
        $user->createAdmin();

        $response = $this->post('/login', [
            'email' => 'admin@email.com',
            'password' => 'admin123!',
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . Session::get('token'))->get('/', [
            'page' => 1,
            'searchVal' => '',
            'orderBy' => 'id',
            'paginate' => 10,
        ]);

        $response->assertStatus(200);
    }

    public function test_fail_dashboard(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function test_users(): void
    {
        $user = new TestPreparer;
        $user->createAdmin();

        $response = $this->post('/login', [
            'email' => 'admin@email.com',
            'password' => 'admin123!',
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . Session::get('token'))->get('/users');

        $response->assertStatus(200);
    }

    public function test_visitors(): void
    {
        $user = new TestPreparer;
        $user->createAdmin();

        $response = $this->post('/login', [
            'email' => 'admin@email.com',
            'password' => 'admin123!',
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . Session::get('token'))->get('/visitors', [
            'page' => 1,
            'searchVal' => '',
            'orderBy' => 'id',
            'paginate' => 10,
        ]);

        $response->assertStatus(200);
    }

    public function test_winners(): void
    {
        $user = new TestPreparer;
        $user->createAdmin();

        $response = $this->post('/login', [
            'email' => 'admin@email.com',
            'password' => 'admin123!',
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . Session::get('token'))->get('/winners', [
            'page' => 1,
            'searchVal' => '',
            'orderBy' => 'id',
            'paginate' => 10,
        ]);

        $response->assertStatus(200);
    }
}
