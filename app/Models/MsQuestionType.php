<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsQuestionType extends Model
{
    protected $table = "ms_question_type";

    protected $fillable = [
        'title',
    ];

    public function msQuestion()
    {
        return $this->belongsTo(MsQuestion::class);
    }
}
