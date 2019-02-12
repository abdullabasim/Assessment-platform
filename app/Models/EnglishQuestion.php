<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnglishQuestion extends Model
{
    protected $table = "english_question";

    protected $fillable = [
        'english_main_question_id',
        'english_question_type_id',
        'title',
        'question_level_id'

    ];

    public function englishMainQuestion()
    {
        return $this->belongsTo(EnglishMainQuestion::class);
    }

    public function englishQuestionType()
    {
        return $this->hasOne(EnglishQuestionType::class, 'id', 'english_question_type_id');
    }

    public function questionLevel()
    {
        return $this->hasOne(QuestionLevel::class, 'id', 'question_level_id');
    }

    public function englishQuestionAnswer()
    {
        return $this->hasOne(EnglishQuestionAnswer::class, 'english_question_id', 'id');
    }

    public function userAnswer()
    {
        return $this->hasOne(UserAnswer::class, 'english_question_id', 'id');
    }

    public function exam()
    {
        return $this->hasOne(ExamQuestion::class, 'english_question_id', 'id');
    }
}
