<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'newImage' => 'image',
            'newTitle' => 'bail|required|max:150',
            'previewContent' => 'bail|required|max:350',
            'fullContent' => 'bail|required|max:999'
        ];
    }
}
