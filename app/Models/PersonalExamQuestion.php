<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalExamQuestion extends Model
{
    protected $table = "personal_exam_question";

    protected $fillable = [
        'personal_question_id',
        'exam_id'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function personalQuestion()
    {
        return $this->hasOne(PersonalQuestion::class, 'id', 'personal_question_id');
    }
}
