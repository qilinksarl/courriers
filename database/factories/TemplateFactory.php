<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Template>
 */
class TemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->sentence();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'content' => $this->faker->sentence(12),
            'model' => ['text' => $this->faker->sentence(24)],
        ];
    }
}
