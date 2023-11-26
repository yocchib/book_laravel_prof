<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;             // p74 taka コメントアウト
use App\Http\Requests\Tweet\CreateRequest;  // p74 taka 追加

use App\Models\Tweet;   // Tweetモデルを使って DBにアクセス (p80 taka)
use App\Services\TweetService;  // (p237 taka)


class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // public function __invoke(CreateRequest $request)  // p74 引数変更 (Request $request)
    public function __invoke(CreateRequest $request, TweetService $tweetService)
    {
       // p80(taka) 以下ロジック追加
       // $tweet = new Tweet;
       // $tweet->user_id = $request->userId(); // p132(taka) ここでUserIdを保存している
       // $tweet->content = $request->tweet();     // RequestForm の tweetメソッドで、データを取得
       // $tweet->save();                          // データベースに保存

       // p238 (taka) 画像も保存できるように修正
       $tweetService->saveTweet(
            $request->userId(),
            $request->tweet(),
            $request->images()
       );

       return redirect()->route('tweet.index');  // redirectヘルパー関数で、元の画面に戻す
                                                // Routeメソッドに Routeでつけた名前を指定することでURLパスに変換してくれる
    }
}
