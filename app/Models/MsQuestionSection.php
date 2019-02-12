<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsQuestionSection extends Model
{
    protected $table = "ms_question_section";

    protected $fillable = [
        'title',
    ];

    public function msQuestion()
    {
        return $this->belongsTo(MsQuestion::class);
    }
}
