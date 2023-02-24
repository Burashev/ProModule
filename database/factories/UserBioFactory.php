<?php

namespace Database\Factories;

use App\Models\UserBio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserBio>
 */
class UserBioFactory extends Factory
{
    protected $model = UserBio::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sex = ['Мужчина', 'Женщина'];

        return [
            'name' => $this->faker->name(),
            'sex' => $sex[array_rand($sex)],
            'city' => $this->faker->city(),
            'institution' => $this->faker->word(),
            'institution_type' => $this->faker->word()
        ];
    }
}
