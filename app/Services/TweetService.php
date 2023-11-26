<?php

namespace App\Services;

use App\Models\Tweet;
use Carbon\Carbon;      // p216 taka

use App\Models\Image;                   // p236 taka
use Illuminate\Support\Facades\DB;      // p236 taka
use Illuminate\Support\Facades\Storage; // p236 taka


class TweetService
{
    public function getTweets()
    {
        // return Tweet::orderBy('created_at', 'DESC')->get();

        // with()をつけることで Tweet取得時にまとめて Imageも取得するように SQLが実行される (p228 taka)
        return Tweet::with('images')->orderBy('created_at', 'DESC')->get(); // (p228 taka)
    }

    // 自分のtweetかどうかをチェックするメソッド  (p138 taka)
    public function checkOwnTweet(int $userId, int $tweetId): bool
    {
        $tweet = Tweet::where('id', $tweetId)->first();
        if (!$tweet) {
            return false;
        }
        return $tweet->user_id === $userId;
    }

    // 前日のつぶやきを集計するメソッド (p216 taka 追加)
    public function countYesterdayTweets(): int
    {
        return Tweet::whereDate('created_at', '>=', Carbon::yesterday()->toDateTimeString())
            ->whereDate('created_at', '<', Carbon::today()->toDateTimeString())
            ->count();
    }

    // 画像を含めたつぶやきの保存処理 (サービスクラスに実装) (p236 taka)
    public function saveTweet(int $userId, string $content, array $images)
    {
        DB::transaction(function () use ($userId, $content, $images) {
            $tweet = new Tweet;
            $tweet->user_id = $userId;
            $tweet->content = $content;
            $tweet->save();
            foreach ($images as $image) {
                Storage::putFile('public/images', $image);
                $imageModel = new Image();
                $imageModel->name = $image->hashName();
                $imageModel->save();
                $tweet->images()->attach($imageModel->id);
            }
        });
    }
    // 画像を含めたつぶやきの削除処理 (サービスクラスに実装) (p242 taka)
    // (1) 対象のつぶやきモデルの取得 
    // (2) つぶやきモデルに紐づいているが画像を１件ずつ参照 
    // (3) 画像モデルからファイルパスを生成し、Fileクラス(ファサード)を利用して利用して画像の実体を確認
    // (4) 画像があれば削除
    // (5) つぶやきと画像の紐づけを detach で削除
    // (6) 画像モデルを削除
    public function deleteTweet(int $tweetId)
    {
        DB::transaction(function () use ($tweetId) {
            $tweet = Tweet::where('id', $tweetId)->firstOrFail(); // (1) 対象のつぶやきモデルの取得 (p242 taka)
            $tweet->images()->each(function ($image) use ($tweet){// (2) つぶやきモデルに紐づいているが画像を１件ずつ参照  (p242 taka)
                $filePath = 'public/images/' . $image->name;      // (3) 画像モデルからファイルパスを生成   (p242 taka)
                if(Storage::exists($filePath)){                   //     Fileクラス(ファサード)を利用して利用して画像の実体を確認 (p242 taka)
                    Storage::delete($filePath);                   // (4) 画像があれば削除 (p242 taka)
                }
                $tweet->images()->detach($image->id);    // (5) つぶやきと画像の紐づけを detach で削除 (p242 taka)
                $image->delete();                        // (6) 画像モデルを削除 (p242 taka)
            });

            $tweet->delete();
        });
    }
}


