<?php

namespace App\Http\Requests\Tweet;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;    // false -> true 変更 (p84 taka)
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
        return [
            'tweet' => 'required|max:140'  // p84 taka 追加 (tweetは必須かつ140字以下)
        ];
    }

    // p84(taka) tweet メソッド追加
    //  (Requestクラスを継承しているので $this->input() を利用してリクエストからデータ取得)
    public function tweet(): string
    {
        return $this->input('tweet'); // リクエストからデータ取得(第１引数は所得するデータ名)
    }

    // p90(taka) id メソッド追加
    public function id(): int
    {
        return (int) $this->route('tweetId');
    }

}
