<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalUserAnswer extends Model
{
    protected $table = "personal_user_answer";

    protected $fillable = [
        'personal_question_id',
        'answer',
        'score',
        'personal_exam_id'
    ];

    public function personalQuestion()
    {
        return $this->belongsTo(PersonalQuestion::class);
    }

    public function personalExam()
    {
        return $this->hasOne(Exam::class, 'id', 'personal_exam_id');
    }
}
