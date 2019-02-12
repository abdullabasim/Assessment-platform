<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionLevel extends Model
{
    protected $table = "question_level";

    protected $fillable = [
        'title'
    ];
    public function englishQuestion()
    {
        return $this->belongsTo(EnglishQuestion::class);
    }

}
