<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
// use App\Models\Tweet;            // p67 追加 taka
use App\Services\TweetService;      // DI(依存性の注入) (p105 taka)

use Illuminate\Http\Request;


class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // p107 : Laravelサービスコンテナにより、
    //        コンストラクタやメソッドの引数で設定された型宣言を自動判断し、それに対応するクラスをインスタンス化する
    public function __invoke(Request $request, TweetService $tweetService ) // DI(依存性の注入) (p105 taka) 
    {
        // dd($tweets);        // p67 追加 taka
        // $tweets = Tweet::orderBy('created_at', 'DESC')->get(); // p82 taka
        // $tweetService = new TweetService();     // DI(依存性の注入) (p105 taka)
        $tweets = $tweetService->getTweets();   // DI(依存性の注入) (p105 taka)

        // Eager Loading 手法の検証のために  デバッグコードを仕込んで以下確認 (p228 taka)
        // dump($tweets); //  (p228 taka)
        // app(\App\Exceptions\Handler::class)->render(request(), throw new \Error('dump report.'));  // (p228 taka)

        return view('tweet.index')                // p68 書換え taka
                    ->with('tweets', $tweets);    // p68 書換え taka ($tweets データを bladeテンプレートに渡す)

    }
}
