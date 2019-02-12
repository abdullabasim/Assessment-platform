<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "department";

    protected $fillable = [
        'title',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
