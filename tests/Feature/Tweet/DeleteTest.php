<?php

namespace Tests\Feature\Tweet;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;  // (p259 taka  テスト用のユーザ
use App\Models\Tweet; // (p259 taka) テスト用のつぶやき


class DeleteTest extends TestCase
{

    use RefreshDatabase;    // テスト実行前後にデータベースを初期化する (p258 taka) 

   // (p257 taka) テスト関数を追加 
    public function test_delete_successed()
    {
        $user = User::factory()->create(); // テスト用ユーザーを作成 (p259 taka)
        $tweet = Tweet::factory()->create( ['user_id' => $user->id]); // つぶやきを作成 (p259 taka)

        $this->actingAs($user); // 指定したユーザーでログインした状態にする (p261 taka)

        // $response = $this->delete('/tweet/delete/1'); // (p257 taka)
        $response = $this->delete('/tweet/delete/' . $tweet->id); // (p260 taka)作成したつぶやきIDを指定

        $response->assertRedirect('/tweet');          // (p257 taka)
    }

}
