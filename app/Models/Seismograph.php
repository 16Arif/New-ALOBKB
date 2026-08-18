<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seismograph extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];
}
