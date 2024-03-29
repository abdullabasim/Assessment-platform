<?php

namespace App\Http\Requests\MsExam;

use Illuminate\Foundation\Http\FormRequest;

class SaveMsAnswer extends FormRequest
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
            'ms.*'=>'required',
            'msTextArea.*'=>'required',
            'dumy'=>'required|numeric',
        ];
    }
}
