<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lounge extends Model
{
    use HasFactory;
    
    protected $table = 'lounges';

    protected $fillable = [
        'lounge_name',
        'desctription',
        'ratings',
        'location'
    ];
}
