<?php

namespace Database\Seeders;

use Domains\Catalog\Models\Skill;
use Domains\Shared\Enums\RolesEnum;
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

        $expert = User::factory()
            ->createOne([
                'role_id' => RolesEnum::EXPERT_ID,
                'email' => 'expert@ya.ru',
            ]);

        $expert->bio()->save(UserBio::factory()->makeOne());
        $expert->skills()->saveMany(Skill::factory(fake()->numberBetween(1, 3))->make());

        $competitor = User::factory()
            ->createOne([
                'role_id' => RolesEnum::COMPETITOR_ID,
                'email' => 'competitor@ya.ru',
            ]);

        $competitor->bio()->save(UserBio::factory()->makeOne());
        $competitor->skills()->saveMany(Skill::factory(fake()->numberBetween(1, 3))->make());
    }
}
