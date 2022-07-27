<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->name(),
            'slug' => $this->faker->name(),
            'image' => $this->faker->image('public/images', 640, 480, null, false),
            'term_id' => rand(1,10),
            'user_id' => rand(1,10),
            'taxonomy_id' => rand(1,10),
        ];
    }
}
