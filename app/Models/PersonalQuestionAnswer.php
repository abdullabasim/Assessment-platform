<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalQuestionAnswer extends Model
{
    protected $table = "personal_question_answer";

    protected $fillable = [
        'personal_question_id',
        'answer1',
        'answer2',
        'answer3',
        'answer4',
        'correct',

    ];
    public function personalQuestion()
    {
        return $this->belongsTo(PersonalQuestion::class);
    }

}
