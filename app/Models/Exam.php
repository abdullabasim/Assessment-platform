<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = "exam";

    protected $fillable = [
        'user_id',

    ];

    public function examQuestion()
    {
        return $this->hasOne(ExamQuestion::class, 'english_question_id', 'id');
    }

    public function examPersonalQuestion()
    {
        return $this->hasOne(PersonalExamQuestion::class, 'personal_question_id', 'id');
    }
}
