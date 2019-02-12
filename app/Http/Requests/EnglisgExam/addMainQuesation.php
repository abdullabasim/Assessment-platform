<?php

namespace App\Http\Requests\EnglisgExam;

use Illuminate\Foundation\Http\FormRequest;

class addMainQuesation extends FormRequest
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
            'question'=>'required|max:255|min:2',
        ];
    }
}
