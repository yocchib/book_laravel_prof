<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tweet;            // 追加 (p95 taka)
use App\Services\TweetService;;  // 追加 (p140 taka)
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;  // 追加 (p140 taka)

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, TweetService $tweetService)  // p140 taka : 第2引数追加
    {
        // 追加  (p95 taka)
        $tweetId = (int) $request->route('tweetId');  // URIパスパラメータより id を得る

        // (p140 taka) checkOwnTweet 条件式追加
        if (!$tweetService->checkOwnTweet($request->user()->id, $tweetId)) {
            throw new AccessDeniedHttpException();
        }

        // $tweet = Tweet::where('id', $tweetId)->firstOrFail();  // id で Eloquentモデルを取得
        // $tweet->delete();  // 対象モデルを削除することで、DB削除
        $tweetService->deleteTweet($tweetId);  // (p243 taka) 上記２行をコメントアウトし、本行追加 

        return redirect()
            ->route('tweet.index')
            ->with('feedback.success', "つぶやきを削除しました");
    }
}


    

