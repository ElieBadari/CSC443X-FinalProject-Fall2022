<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoungeRating extends Model
{
    use HasFactory;

    protected $table = 'lounges_ratings';

    protected $fillable = [
        'user_id',
        'lounge_id',
        'rating',
        'review'
    ];
}
