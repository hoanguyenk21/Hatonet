<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->name(),
            'description' => $this->faker->unique(),
            'slug' => $this->faker->unique(),
            'user_id' => function() {
                // return Factory(App\Models\User::class)->create()->id;
            },
        ];
    }
}
