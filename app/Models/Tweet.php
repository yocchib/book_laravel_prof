<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    // (p134 taka) Tweetモデルから Userモデルへの関連付け (多 対１) 
    public function user()
    {
      return $this->belongsTo(User::class);// (p134 taka) Tweetモデルから Userモデルへの関連 (多 対１) 
    }

    // (p225 taka) Tweetモデルから 交差テーブルを利用した Imageモデルへの関連付け 
    //  これで、多 対 多　の関係で TweetImage の Pivotモデルを経由して Image モデルが取得できる
    //  多対多の関係になっているが、Imageが複数のTweetを保持しないため、実質１対多の関係
    public function images()
    {
        return $this->belongsToMany(Image::class, 'tweet_images')->using(TweetImage::class);
    }


}
