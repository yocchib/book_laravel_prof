<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;             // 追加 (p86 taka)
use App\Services\TweetService;    // 追加 (p138 taka)

// use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; // 追加 (p86 taka)
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException; // 追加 (p138 taka)

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, TweetService $tweetService)  // 第２引数追加 (p138 taka)
    {
        $tweetId = (int) $request->route('tweetId'); // p86 taka
        // dd($tweetId); // p86 テスト表示
        if (!$tweetService->checkOwnTweet($request->user()->id, $tweetId)) {  // p138 taka
                throw new AccessDeniedHttpException();                        // p138 taka
        }                                                                     // p138 taka

        // p86 taka
        $tweet = Tweet::where('id', $tweetId)->firstOrFail(); // クエリビルダで idをキーに DB検索

        return view('tweet.update')->with('tweet', $tweet);  // p89

        // $tweet = Tweet::where('id', $tweetId)->first();
        // if (is_null($tweet)) {
        //    throw new NotFoundHttpException('存在しないつぶやきです');
        // }

        // dd($tweet);  // p89

      /*
        $tweet = Tweet::where('id', $tweetId)->firstOrFail();
        return view('tweet.update')->with('tweet', $tweet);
       */
    }

}
