<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    
        /**
        * table to store teachers records.
        */
    protected $table = 'games';

    protected $fillable = [
        'game_name',
        'pic_url',
        'category_id'
    ];
}
