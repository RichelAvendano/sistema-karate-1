<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dojo extends Model
{
    protected $fillable = [
        'name',
        'description',
        'photo',
        'location'
    ];

    // Relación: Un dojo pertenece a un sensei
    public function sensei()
    {
        return $this->hasOne(Sensei::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class , 'dojo_id', 'id'); // ✅ Relación correcta
    }

    public function event()
    {
        return $this->belongsToMany(Event::class, 'dojo_event');
    }
}

