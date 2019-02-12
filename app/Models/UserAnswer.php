<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $table = "user_answer";

    protected $fillable = [
        'english_question_id',
        'answer',
        'score',
        'exam_id'
    ];

    public function englishQuestion()
    {
        return $this->belongsTo(EnglishQuestion::class);
    }

    public function exam()
    {
        return $this->hasOne(Exam::class, 'id', 'exam_id');
    }
}
