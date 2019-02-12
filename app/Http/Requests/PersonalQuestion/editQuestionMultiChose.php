<?php

namespace App\Http\Requests\PersonalQuestion;

use Illuminate\Foundation\Http\FormRequest;

class editQuestionMultiChose extends FormRequest
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

            'questionId'=>'required|numeric',
            'answer1'=>'required|string',
            'answer2'=>'required|string',
            'answer3'=>'required|string',
            'answer4'=>'required|string',
            'correct'=>'required|string',
        ];
    }
}
