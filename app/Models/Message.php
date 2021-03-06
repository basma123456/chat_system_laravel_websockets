<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'message',
        'photo',
        'user_id',
        'receiver_id',
        'created_at',
        'updated_at'
    ];

}
