<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'event_type',
        'start_date',
        'end_date',
        'location',
        'max_dojo',
        'max_sensei',
        'max_student',
        'participant_type'
    ];

    /**
     * Relación muchos a muchos con Dojos
     */
    public function dojo()
    {
        return $this->belongsToMany(Dojo::class, 'dojo_event');
    }

    /**
     * Relación muchos a muchos con Estudiantes
     */
    public function student()
    {
        return $this->belongsToMany(Student::class, 'event_student');
    }

    public function sensei()
    {
        return $this->belongsToMany(Sensei::class, 'event_sensei');
    }
}

