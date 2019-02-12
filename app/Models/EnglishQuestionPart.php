<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnglishQuestionPart extends Model
{
    protected $table = "english_question_part";

    protected $fillable = [
        'title',
    ];

    public function englishMainQuestion()
    {
        return $this->belongsTo(EnglishMainQuestion::class);
    }
}
