<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use App\MyClasses\MyNumber;   // 高橋 独自クラス定義 
use App\MyClasses\MyCustomClass; // 高橋 独自クラス定義 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 通常はここでバインド処理
        $this->app->bind('mycustomclass', function () {
            return new MyCustomClass();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // インスタンス生成時、他のクラスを利用する必要があるときは、ここでバインド処理
    }
}
