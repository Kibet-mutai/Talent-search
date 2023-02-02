<?php

namespace Database\Seeders;

use App\Models\HireFreelancer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HireFreelancerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HireFreelancer::factory(20)->create();
    }
}
