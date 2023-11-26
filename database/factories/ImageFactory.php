<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;  // (p224 taka) 追加

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [ ];

     // (p224 taka)  以下画像ファイル生成ロジックを記述
     // ディレクトリがなければ作成する
     if (!Storage::exists('public/images')) {
         Storage::makeDirectory('public/images');
     }
     return [  // Fakerを利用して画像生成 (storage/app/imagesフォルダ に格納される)
       'name' => $this->faker->image(storage_path('app/public/images'), 640, 480, null, false)
     ];

    }
}
