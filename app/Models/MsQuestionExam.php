<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsQuestionExam extends Model
{
    protected $table = "ms_exam_question";

    protected $fillable = [
        'ms_question_id',
        'ms_exam_id'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function msQuestion()
    {
        return $this->hasOne(MsQuestion::class, 'id', 'ms_question_id');
    }
}
