<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensei extends Model
{
    protected $fillable = [
        'name',
        'kyu',
        'date_of_birth',
        'organization',
        'photo',
        'dojo_id',
        'user_id'
    ];

    public function dojo()
    {
        return $this->belongsTo(Dojo::class);
    }


    public function student(){
        return $this->hasMany(Student::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
