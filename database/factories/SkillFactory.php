<?php

namespace Database\Factories;

use Domains\Catalog\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domains\Catalog\Models\Skill>
 */
class SkillFactory extends Factory
{
    protected $model = Skill::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word(),
            'name' => fake()->word
        ];
    }
}
