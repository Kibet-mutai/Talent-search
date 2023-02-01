<?php

namespace Database\Seeders;

use App\Models\Freelancer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(1)
            ->create()
            ->each(
                function ($user) {
                    $user->assignRole('super_admin');
                }
            );
        User::factory()->count(15)
            ->create()
            ->each(
                function ($user) {
                    $user->assignRole('employer');
                }
            );

        collect(User::factory()->count(15)
            ->has(Freelancer::factory(1))
            ->create())
            ->each(
                function ($user) {
                    $user->assignRole('freelancer');
                }
            );
    }
}
