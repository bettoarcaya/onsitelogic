<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantList extends Model
{
    protected $table = 'participant_lists';
    protected $fillable = ['participant_id', 'event_id'];
}
