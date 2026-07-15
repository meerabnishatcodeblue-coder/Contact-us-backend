<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'business',
        'order',
        'size',
        'sign_type',
        'topic',
        'call_time',
        'message',
    ];
}
