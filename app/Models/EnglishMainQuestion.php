<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnglishMainQuestion extends Model
{
    protected $table = "english_main_question";

    protected $fillable = [
        'english_question_part_id',
        'title',
        'path'

    ];

    public function englishQuestionPart()
    {
        return $this->hasOne(EnglishQuestionPart::class, 'id', 'english_question_part_id');
    }

    public function englishQuestion()
    {
        return $this->hasMany(EnglishQuestion::class, 'english_main_question_id', 'id');
    }
}
