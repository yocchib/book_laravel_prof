<?php

namespace App\Console\Commands;

use App\Mail\DailyTweetCount;           // p215 taka 追記
use App\Models\User;                    // p215 taka 追記
use App\Services\TweetService;          // p215 taka 追記
use Illuminate\Console\Command;
use Illuminate\Contracts\Mail\Mailer;   // p215 taka 追記

class SendDailyTweetCountMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-daily-tweet-count-mail';  // p215 taka 変更

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description ='前日のつぶやき数を集計してつぶやきを促すメールを送ります。'; // p215 taka 変更

    private TweetService $tweetService;  // p215 taka
    private Mailer $mailer;              // p215 taka

    // p215 taka コンストラクタ定義
    public function __construct(TweetService $tweetService, Mailer $mailer)
    {
        parent::__construct();
        $this->tweetService = $tweetService;
        $this->mailer = $mailer;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // p216 taka  前日のつぶやきを集計してメール送信するロジック追加
        $tweetCount = $this->tweetService->countYesterdayTweets();
        $users = User::get();

        foreach ($users as $user) {
            $this->mailer->to($user->email)
                ->send(new DailyTweetCount($user, $tweetCount));
        }

        return 0;

    }
}
