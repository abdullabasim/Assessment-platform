<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalAnswerType extends Model
{
    protected $table = "personal_answer_type";

    protected $fillable = [
        'answer1',
        'answer2',
        'personal_question_id'

    ];

    public function personalQuestion()
    {
        return $this->belongsTo(PersonalQuestion::class);
    }
}
