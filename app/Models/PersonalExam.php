<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalExam extends Model
{
    protected $table = "personal_exam";

    protected $fillable = [
        'user_id',

    ];
}
