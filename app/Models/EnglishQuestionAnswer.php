<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnglishQuestionAnswer extends Model
{
    protected $table = "english_question_answer";

    protected $fillable = [
        'english_question_id',
        'answer1',
        'answer2',
        'answer3',
        'answer4',
        'correct',

    ];

    public function englishQuestion()
    {
        return $this->belongsTo(EnglishQuestion::class);
    }
}
