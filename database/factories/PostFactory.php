<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'locale'=> $this->faker->randomElement(['en', 'ar']),
            'title' => $this->faker->words(10, true),
            'body' => $this->faker->sentence(1000),
            'excerpt' => $this->faker->sentence(50),
            'author_id' => $this->faker->numberBetween(1, 4),
            'category_id' => $this->faker->numberBetween(1, 4),
            'is_active'=> 1,
            'status'=>'PUBLISHED',
            'featured'=>$this->faker->randomElement([1,0]),
            'created_at'=> $this->faker->unique()->dateTimeInInterval($startDate = '-20 days', $interval = '+ 5 days', $timezone = null) 
        ];
    }
}
