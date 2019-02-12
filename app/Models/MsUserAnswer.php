<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsUserAnswer extends Model
{
    protected $table = "ms_user_answer";

    protected $fillable = [
        'ms_question_id',
        'answer',
        'score',
        'ms_exam_id'
    ];

    public function msQuestion()
    {
        return $this->belongsTo(MsQuestion::class);
    }

    public function msExam()
    {
        return $this->hasOne(Exam::class, 'id', 'ms_question_id');
    }
}
