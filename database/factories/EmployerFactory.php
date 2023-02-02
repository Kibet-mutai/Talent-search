<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name'=>$this->faker->firstName(),
            'last_name'=>$this->faker->lastName(),
            'company_name'=>$this->faker->company(),
            'company_size'=>$this->faker->randomElement(['Mid-size company', 'Small-size company', 'Large company']),
            'location'=>$this->faker->city()
        ];
    }
}
