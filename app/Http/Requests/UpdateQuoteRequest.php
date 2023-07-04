<?php

namespace App\Http\Requests;

use App\Rules\ImageOrNullRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateQuoteRequest extends FormRequest
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
            'quote_en' => 'nullable',
            'quote_ka' => 'nullable',
            'image' => 'image',
        ];
    }
}
