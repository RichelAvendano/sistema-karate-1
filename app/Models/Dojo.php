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
}

