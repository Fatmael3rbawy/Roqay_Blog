<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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

            'title' => $this->faker->word(),
            'body' => $this->faker->text(),
            'image' => $this->faker->image('public/images/posts',640,480, null, false),
            'user_id' => \App\Models\User::all()->random()->id,
            'category_id'  => \App\Models\Category::all()->random()->id,
            
        ];
    }
}
