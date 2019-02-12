<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnglishQuestionType extends Model
{
    protected $table = "english_question_type";

    protected $fillable = [
        'title',
    ];

    public function englishQuestion()
    {
        return $this->belongsTo(EnglishQuestion::class);
    }
}
