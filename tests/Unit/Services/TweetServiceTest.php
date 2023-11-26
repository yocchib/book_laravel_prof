<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\TweetService;    // p250 taka
use Mockery ;                     // p250 taka

class TweetServiceTest extends TestCase
{
    /**
     * @runInSeparateProcess
     * @return void
     */
    
    public function test_check_own_tweet(): void
    {
        $tweetService = new TweetService(); // (p250 taka)TweetServiceのインスタンスを作成

        $mock = Mockery::mock('alias:App\Models\Tweet');  // (p250 taka) 
        $mock->shouldReceive('where->first')->andReturn((object)[   // (p250 taka)
                'id' => 1,                                          // (p250 taka)
                'user_id' => 1                                      // (p250 taka)
        ]);                                                         // (p250 taka)

        $result = $tweetService->checkOwnTweet(1, 1); // (p250 taka)
        $this->assertTrue($result);                   // (p250 taka)

        $result = $tweetService->checkOwnTweet(2, 1); // (p250 taka)
        $this->assertFalse($result);                  // (p250 taka)
    }
    
}
