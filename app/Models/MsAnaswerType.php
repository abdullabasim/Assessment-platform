<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsAnaswerType extends Model
{
    protected $table = "ms_answer_type";

    protected $fillable = [
        'title',
    ];

    public function msQuestion()
    {
        return $this->belongsTo(MsQuestion::class);
    }
}
