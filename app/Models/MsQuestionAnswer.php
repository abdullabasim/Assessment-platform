<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsQuestionAnswer extends Model
{
    protected $table = "ms_question_answer";

    protected $fillable = [
        'ms_question_id',
        'answer1',
        'answer2',
        'answer3',
        'answer4',
        'correct',

    ];

    public function msQuestion()
    {
        return $this->belongsTo(MsQuestion::class);
    }
}
