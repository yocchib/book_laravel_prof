<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;  // p57 追加 taka
// use Illuminate\Support\Str;         // p57 追加 taka
use App\Models\Tweet;        // p65 追加 taka 
use App\Models\Image;        // p226 追加 taka 

class TweetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // (p226 taka) TweetFactory から 10件作成し、ImageFactoryから4件データを生成する
        //   生成した tweetsレコードのデータから Tweetモデルにより Pivotモデルを経由して
        //   attach で ImageId を紐づけて交差テーブルに保存する
        //   
        Tweet::factory()->count(10)->create()->each(fn($tweet) =>
            Image::factory()->count(4)->create()->each(fn($image) =>
                $tweet->images()->attach($image->id)
            )
        );

        // Tweet::factory()->count(10)->create();  // p65 追加 taka

        //  p57 追加 taka
        /*
            DB::table('tweets')->insert([
                'content' => Str::random(100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        */
    }
}
