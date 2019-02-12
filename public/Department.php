<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

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
