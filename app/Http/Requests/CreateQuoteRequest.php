<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuoteRequest extends FormRequest
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
            'quote_en' => 'required',
            'quote_ka' => 'required',
            'image' => 'required|image',
            'user_id' => 'required|exists:users,id',
            'movie_id' => 'required|exists:movies,id',
        ];
    }
}
