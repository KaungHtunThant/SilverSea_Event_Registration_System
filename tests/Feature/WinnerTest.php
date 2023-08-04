<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Visitor;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\TestPreparer;

class WinnerTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @return void
     *
    **/

    public function test_rng(): void
    {
        $visitors = Visitor::factory()->count(10)->create();
        $user = new TestPreparer;
        $user->createAdmin();

        $response = $this->post('/login', [
            'email' => 'admin@email.com',
            'password' => 'admin123!',
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . Session::get('token'))->post('/winners');

        $response->assertSessionHas('status.type', 'success');
    }
}
