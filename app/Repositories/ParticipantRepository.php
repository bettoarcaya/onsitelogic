<?php
/**
 * Created by PhpStorm.
 * User: b3tt0
 * Date: 27/12/19
 * Time: 03:35 PM
 */
namespace App\Repositories;
use App\Models\Participant;
use App\Models\UserType;
use Illuminate\Support\Facades\DB;

class ParticipantRepository
{
    public function getAll()
    {
        $response = Participant::paginate(10);

        return $response;
    }

    public function getAllTypes()
    {    
        $response = UserType::All();

        return $response;
    }

    public function add($data)
    {
        return Participant::create($data);
    }

    public function getParticipant($participant_id)
    {
        $response = Participant::findOrFail($participant_id);

        return $response;
    }
}