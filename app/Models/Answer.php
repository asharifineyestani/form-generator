<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $fillable = [
        'body',
        'form_id'
    ];

    protected $casts = [
        'body' => 'json'
    ];
}
