<?php

namespace App\Http\Requests\EnglishExam;

use Illuminate\Foundation\Http\FormRequest;

class editGrammarQuestionBox extends FormRequest
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
            'title'=>'required|string',

            'questionId'=>'required|numeric'
        ];
    }
}
