<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalQuestionType extends Model
{
    protected $table = "personal_question_type";

    protected $fillable = [
        'title',
    ];

    public function personalQuestion()
    {
        return $this->belongsTo(PersonalQuestion::class);
    }
}
