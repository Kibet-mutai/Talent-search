<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\Freelancer;
use App\Models\HireFreelancer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $freelancer = Freelancer::inRandomOrder()->first();
        $employer = Employer::inRandomOrder()->first();

        return [
            'employer_id' => $employer,
            'freelancer_id' => $freelancer,
            'rating'=> $this->faker->randomElement([1, 2, 3, 4, 5]),
            'review' => $this->faker->sentence()
        ];
    }
}
