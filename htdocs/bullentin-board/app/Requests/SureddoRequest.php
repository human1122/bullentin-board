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
            'text' => 'required|max:1000',
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
        ];
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function message(): array
    {
        return [

        ];
    }
}
