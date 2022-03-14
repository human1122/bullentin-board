<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SureddoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
        ];
    }

    /**
     * エラーメッセージの日本語化
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'user_id' => 'ユーザーID',
            'text' => '投稿文',
            'henshin_text' => '返信文'
        ];
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'henshin_text.required' => "返信するときは必ず:attributeを入力してください。",
            'text.required' => ':attributeは必ず入力してください。',
        ];
    }

    /**
     * バリデータインスタンスの設定
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        if (!empty(request()->sureddo_id)) {
            $validator->sometimes('henshin_text', 'required|max:1000', function() {
                return true;
            });
        } else {
            $validator->sometimes('text', 'required|max:1000', function() {
                return true;
            });
        }
    }
}
