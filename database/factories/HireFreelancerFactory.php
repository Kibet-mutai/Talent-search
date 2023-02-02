<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\Freelancer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HireFreelancer>
 */
class HireFreelancerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $employer = Employer::inRandomOrder()->first();
        $freelancer = Freelancer::inRandomOrder()->first();
        return [
            'employer_id' => $employer->id,
            'freelancer_id' => $freelancer->id,
            'job_type' => $this->faker->randomElement(['full-time', 'contract-based', 'part-time', 'on-site', 'remote', 'hybrid']),
            'job_description' => $this->faker->sentence,
            'payment_rates' => $this->faker->randomFloat(2, 10, 100),
            'status' => $this->faker->boolean($chanceofGettingTrue = 100)
        ];
    }
}
