<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Visitor;
use Illuminate\Support\Facades\Session;

class AttendanceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_scan(): void
    {
        $visitor = Visitor::factory()->create();
        $response = $this->post('/api/scan/'.$visitor->conf_id);

        $response->assertStatus(200);
    }
}
