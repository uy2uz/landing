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
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'      => 'required|string|min:2|max:140',
            'author'     => 'required|string|min:2|max:40',
            'categories' => 'required|array',
            'short_text' => 'required|string|min:3|max:200',
            'full_text'  => 'required|string|min:3',
            
        ];
    }
}
