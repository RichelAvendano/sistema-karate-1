<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'kyu',
        'date_of_birth',
        'organization',
        'photo',
        'sensei_id',
        'user_id'
    ];

    public function sensei()
    {
        return $this->belongsTo(Sensei::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
