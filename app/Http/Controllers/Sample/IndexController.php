<?php

namespace App\Http\Controllers\Sample;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function show()
    {
        return 'Hello';
    }
    public function showId($id)
    {
        return "Hello ID : {$id}";
    }
    public function page47()
    {
        // view ヘルパー関数を呼び出す
        //  第１引数：テンプレートファイル指定
        //           (resources/views 内で sample/index.blade.php を指定)
        return view('sample.index', ['name' => 'laravel']) ; // p48
    }
}
