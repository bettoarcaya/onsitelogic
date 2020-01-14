<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participants';
    protected $fillable = [
        'name', 
        'lastname', 
        'email', 
        'participant_id', 
        'assistance',
        'type'
    ];
}
