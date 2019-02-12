<?php

namespace App\Http\Requests\EnglishExam;

use Illuminate\Foundation\Http\FormRequest;

class saveAnswers extends FormRequest
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
            'grammar.*'=>'required',
            'listingTextArea.*'=>'required',
            'listeningRadio.*'=>'required',
            'paraArea'=>'required',
            'dumy'=>'required|numeric',
            'para'=>'required|numeric',
        ];
    }
}
