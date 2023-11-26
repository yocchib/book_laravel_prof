<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;  // p217 taka

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tweet>
 */
class TweetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1, // (p129 taka) つぶやきを投稿したユーザーのIDをデフォルトで1とする
            'content' => $this->faker->realText(100),
            'created_at' => Carbon::now()->yesterday(),  // p217 taka
        ];
    }
}
