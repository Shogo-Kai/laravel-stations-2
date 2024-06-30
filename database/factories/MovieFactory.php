<?php

namespace Database\Factories;

use App\Models\Genre; 
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'image_url' => $this->faker->imageUrl(),
            'published_year' => $this->faker->numberBetween(2000, 2024),
            'is_showing' => $this->faker->boolean,
            'description' => $this->faker->paragraph,
            'genre_id' => Genre::factory(), // 関連するジャンルを作成
        ];
    }
}
