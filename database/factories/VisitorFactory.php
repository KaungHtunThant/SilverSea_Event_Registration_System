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

        $lastid = Visitor::latest('id')->first();
        if ($lastid == Null) {
            $id = 'EMP-VIS-'.1001;
        }
        else{
            $id = 'EMP-VIS-'.$lastid->id+1001;
        }

        return [
            'conf_id' => $id,
            'phone' => '09'.rand(10000000, 99999999),
        ];
    }
}
