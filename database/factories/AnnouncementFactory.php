<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'created_by_id' => User::factory(),
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 2, 50),
            'photo_urls' => $this->faker->randomElement([
                ['http://www.example.com', 'http://www.example2.com', 'http://www.example3.com']
            ]),
        ];
    }
}
