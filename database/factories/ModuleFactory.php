<?php

namespace Database\Factories;

use Domains\Catalog\Models\Skill;
use Domains\Module\Models\Module;
use Domains\Shared\Models\User;
use Domains\Shared\Models\UserBio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domains\Module\Models\Module>
 */
class ModuleFactory extends Factory
{
    protected $model = Module::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $skill = Skill::query()->inRandomOrder()->first()->getKey();

        $user = User::factory()
            ->createOne([
                'role_id' => 2
            ]);

        $user->bio()->save(UserBio::factory()->makeOne());
        $user->skills()->attach($skill);

        return [
            'title' => fake()->word(),
            'slug' => fake()->word(),
            'user_id' => $user->id,
            'skill_id' => $skill,
        ];
    }
}
