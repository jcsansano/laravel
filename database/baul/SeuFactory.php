<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seu>
 */
class SeuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return ['nomSeu' => $this->faker->unique()->text(30),
                'ubicacioSeu'=> $this->faker->text(50),
                'correuSeu'=>$this->faker->unique()->email(),
                'notesSeu'=>$this->faker->optional()->paragraph(4),
                'logoSeu'=>$this->faker->optional()->text(30),
                'baixaSeu'=>$this->faker->optional()->dateTime()];
    }
}
