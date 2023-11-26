<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Tweet\UpdateRequest;  // 追加 (p91 taka)
use App\Models\Tweet;  // 追加 (p91 taka)
use App\Services\TweetService;  // 追加 (p139 taka)
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;  // 追加 (p139 taka)

class PutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // public function __invoke(UpdateRequest $request)  // p91 引数を UpdateRequest に変更
    public function __invoke(UpdateRequest $request, TweetService $tweetService) // (p139 taka)  第2引数追加
    {
        // (p139 taka) checkOwnTweet を追加
        if (!$tweetService->checkOwnTweet($request->user()->id, $request->id())) {
                throw new AccessDeniedHttpException();
        }

        // p91 DB更新処理を記述
        $tweet = Tweet::where('id', $request->id())->firstOrFail();  // 対象id のEloquentモデルを取得
        $tweet->content = $request->tweet(); // リクエストの投稿内容で content を更新
        $tweet->save();                      // DB保存
        return redirect()                    // フラッシュセッションデータを with で指定
            ->route('tweet.update.index', ['tweetId' => $tweet->id])
            ->with('feedback.success', "つぶやきを編集しました");

    }
}
