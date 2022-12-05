<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;
     protected $fillable = [
        'id',
        'farmer',
        'cooperative',
        'disease',
        'image',
    ];

}
