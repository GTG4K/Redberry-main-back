<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
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
            'title_en' => 'required',
            'title_ka' => 'required',
            'director_en' => 'required',
            'director_ka' => 'required',
            'description_en' => 'required',
            'description_ka' => 'required',
            'release_date' => 'required|numeric',
            'genre' => 'required',
            'image' => 'required|image',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
