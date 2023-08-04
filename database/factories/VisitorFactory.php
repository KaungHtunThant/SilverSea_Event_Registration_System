<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Visitor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitor>
 */
class VisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sex = array('Male', 'Female', 'Other');
        
        $id = 'MME-VIS-'.rand(1001, 2000);
        return [
            'conf_id' => $id,
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => '09'.rand(10000000, 99999999),
            'company' => fake()->name(),
            'sex' => $sex[array_rand($sex)],
            'dob' => fake()->dateTimeBetween('-30 days', '+30 days'),
            'card' => $id.'_'.time()
        ];
    }
}
