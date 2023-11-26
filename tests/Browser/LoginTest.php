<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;        // (taka269 taka)

class LoginTest extends DuskTestCase
{
    // (p267 taka) testSuccessfulLogin を定義
    //
    public function testSuccessfulLogin()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create(); // テスト用のユーザーを作成 (p269 taka)

            $browser->visit('/login')   // パスを変更する (p267 taka) 
             // ->type('email', 'test@example.com')  // パスワードを入力する (p268 taka) 
                ->type('email', $user->email)   // テスト用のユーザーのメールアドレスを指定する (p269 taka) 
                ->type('password', 'password')  // パスワードを入力する (p268 taka) 
                ->press('LOG IN')               // 「LOG IN」ボタンをクリックする (p270 taka) 
                ->assertPathIs('/tweet')        // /tweetに遷移したことを確認する (p270 taka) 
                ->assertSee('つぶやきアプリ');   // ページ内に「つぶやきアプリ」が表示されていることの確認 (p271 taka) 
        });
    }

}
