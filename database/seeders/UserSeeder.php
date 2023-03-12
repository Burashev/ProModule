<?php

namespace Database\Seeders;

use Domains\Catalog\Models\Skill;
use Domains\Shared\Models\User;
use Domains\Shared\Models\UserBio;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)
            ->create()
            ->each(
                function (User $user) {
                    $user->bio()->save(UserBio::factory()->makeOne());
                    $user->skills()->saveMany(Skill::factory(fake()->numberBetween(1, 3))->make());
                }
            );
    }
}
