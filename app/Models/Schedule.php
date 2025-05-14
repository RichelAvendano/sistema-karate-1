<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules'; // ✅ Nombre de la tabla

    protected $fillable = [
        'dojo_id',
        'day',
        'start_time',
        'end_time',
        'class_type',
    ]; // ✅ Campos que pueden ser asignados masivamente

    // ✅ Relación con el dojo
    public function dojo()
    {
        return $this->belongsTo(Dojo::class);
    }

    public function sensei()
    {
        return $this->hasOne(Sensei::class, 'dojo_id', 'dojo_id');
    }
}
