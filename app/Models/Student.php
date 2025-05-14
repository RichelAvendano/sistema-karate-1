<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'kyu',
        'date_of_birth',
        'organization',
        'photo',
        'status',
        'sensei_id',
        'dojo_id',
        'user_id'
    ];

    public function sensei()
    {
        return $this->belongsTo(Sensei::class);
    }

    public function dojo()
    {
        return $this->belongsTo(Dojo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsToMany(Event::class, 'event_student');
    }

    
}
