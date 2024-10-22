<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(User::where('email', 'admin@email.com')->exists()) {
            echo "Admin already exists\n";
            return;
        }
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@email.com',
            'password' => 'admin123!', // password
        ]);
    }
}
