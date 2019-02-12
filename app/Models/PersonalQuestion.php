<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalQuestion extends Model
{
    protected $table = "personal_question";

    protected $fillable = [
        'personal_question_type_id',
        'title',
        'question_level_id',


    ];

    public function personalQuestionType()
    {
        return $this->hasOne(PersonalQuestionType::class, 'id', 'personal_question_type_id');
    }

    public function personalQuestionAnswer()
    {
        return $this->hasOne(PersonalQuestionAnswer::class, 'personal_question_id', 'id');
    }

    public function personalExamQuestion()
    {
        return $this->hasOne(PersonalExamQuestion::class, 'personal_question_id', 'id');
    }

    public function questionLevel()
    {
        return $this->hasOne(QuestionLevel::class, 'id', 'question_level_id');
    }

    public function personalAnswerType()
    {
        return $this->hasOne(PersonalAnswerType::class, 'personal_question_id', 'id');
    }
}
