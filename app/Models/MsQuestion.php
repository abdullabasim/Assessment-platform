<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsQuestion extends Model
{
    protected $table = "ms_question";

    protected $fillable = [
        'ms_question_type_id',
        'ms_question_section_id',
        'ms_answer_type_id',
        'title',
        'image_path',
        'question_level_id'

    ];

    public function msQuestionType()
    {
        return $this->hasOne(MsQuestionType::class, 'id', 'ms_question_type_id');
    }

    public function msQuestionSection()
    {
        return $this->hasOne(MsQuestionSection::class, 'id', 'ms_question_section_id');
    }

    public function msAnswerType()
    {
        return $this->hasOne(MsAnaswerType::class, 'id', 'ms_answer_type_id');
    }

    public function msQuestionAnswer()
    {
        return $this->hasOne(MsQuestionAnswer::class, 'ms_question_id', 'id');
    }

    public function msExamQuestion()
    {
        return $this->hasOne(MsQuestionExam::class, 'personal_question_id', 'id');
    }

    public function questionLevel()
    {
        return $this->hasOne(QuestionLevel::class, 'id', 'question_level_id');
    }

}
