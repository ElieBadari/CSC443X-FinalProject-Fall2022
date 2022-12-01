<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoungePicture extends Model
{
    use HasFactory;

    protected $table = 'lounges_ratings';

    protected $fillable = [
        'lounge_id',
        'pic_url',
        'pic_order'
    ];
}
