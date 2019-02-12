<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    protected $table = "exam_question";

    protected $fillable = [
        'english_question_id',
        'exam_id'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function englishQuestion()
    {
        return $this->hasOne(EnglishQuestion::class, 'id','english_question_id');
    }
}
