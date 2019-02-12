<?php

namespace App\Http\Requests\EnglishExam;

use Illuminate\Foundation\Http\FormRequest;

class CorrectAnswer extends FormRequest
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
            'score.*'=>'required|numeric',
            'dumy'=>'required|numeric',
            'written.*'=>'required|numeric',
        ];
    }
}
