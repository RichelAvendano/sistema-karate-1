<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensei extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'dan',
        'date_of_birth',
        'organization',
        'photo',
        'status',
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

    public function event()
    {
        return $this->belongsToMany(Event::class, 'event_sensei');
    }
}
