<?php

namespace App\Http\Requests\Tweet;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;    // p73 taka
        return true;        // p73 taka
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tweet' => 'required|max:140',  // tweetは必須かつ140字以下 (p73 taka) 追加 
            'images' => 'array|max:4', // 画像投稿は任意だが４件まで  (p235 taka)
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // 配列の中身を images.* で宣言するファイルの形式とファイルサイズ上限2M指定(p235 taka)
        ];

    }

    // (p131 taka) Requestクラスのuser関数で今自分がログインしているユーザーが取得できる
    public function userId(): int
    {
        return $this->user()->id;  // p132 taka
    }

    // p80(taka) tweet メソッド追加
    //  (Requestクラスを継承しているので $this->input() を利用してリクエストからデータ取得)
    public function tweet(): string
    {
        return $this->input('tweet'); // リクエストからデータ取得(第１引数は所得するデータ名)
    }

    // p91(taka) id メソッド追加
    public function id(): int
    {
        return (int) $this->route('tweetId');
    }

    // (p237 taka) 画像の取得はファイル投稿なので $this->inputでなく $this->file から取得
    public function images(): array
    {
        return $this->file('images', []);
    }
}
