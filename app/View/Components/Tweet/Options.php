<?php

namespace App\View\Components\Tweet;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Options extends Component
{
    private int $tweetId;   // (p164 taka) つぶやきの作成者
    private int $userId;    // (p164 taka) ログインID

    /**
     * Create a new component instance.
     */
    // (p164 taka) 一覧コンポーネント(resources/views/components/tweet/list.blade.php) から呼び出される
    //       <x-tweet.options :tweetId="$tweet->id" :userId="$tweet->user_id"></x-tweet.options>
    public function __construct(int $tweetId, int $userId) // (p164 taka) 
    {
        $this->tweetId = $tweetId; // (p164 taka) <x-tweet.options :tweetId="$tweet->id" :userId="$tweet->user_id">
        $this->userId = $userId;   // (p164 taka) <x-tweet.options :tweetId="$tweet->id" :userId="$tweet->user_id">
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tweet.options')
        ->with('tweetId', $this->tweetId)            // p164 taka
        ->with('myTweet', \Illuminate\Support\Facades\Auth::id() === $this->userId);
    }
}
