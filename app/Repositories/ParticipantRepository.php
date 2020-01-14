<?php
/**
 * Created by PhpStorm.
 * User: b3tt0
 * Date: 27/12/19
 * Time: 03:35 PM
 */
namespace App\Repositories;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;

class ParticipantRepository
{
    public function getAll(){
        $response = Participant::paginate(10);

        return $response;
    }
}