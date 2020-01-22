<?php
/**
 * Created by PhpStorm.
 * User: b3tt0
 * Date: 27/12/19
 * Time: 03:35 PM
 */
namespace App\Repositories;
use App\Models\Participant;
use App\Models\ParticipantList;
use App\Models\UserType;
use Illuminate\Support\Facades\DB;

class ParticipantRepository
{
    public function getAll()
    {
        $response = DB::table('participant_lists')
                        ->select(
                            'participants.id as participant_id', 
                            'participants.*',
                            'events.event_name'
                            )
                        ->join('participants', 'participant_lists.participant_id', '=', 'participants.id')
                        ->join('events', 'participant_lists.event_id', '=', 'events.id')
                        ->paginate(10);

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

    public function addEvent($participant_id, $event_id)
    {
        return ParticipantList::create([
            'participant_id' => $participant_id, 
            'event_id' => $event_id
        ]);
    }

    public function update($data, $participant_id)
    {
        $participant = DB::table('participants')
                         ->where('id', $participant_id)
                         ->update($data);
        
        return $participant;
    }

    public function search($field, $query)
    {
        $prefield = ($field == 'event_name') ? 'events.'.$field : 'participants.'.$field;
        $response = DB::table('participant_lists')
                        ->select(
                            'participants.id as participant_id', 
                            'participants.*',
                            'events.event_name'
                            )
                        ->join('participants', 'participant_lists.participant_id', '=', 'participants.id')
                        ->join('events', 'participant_lists.event_id', '=', 'events.id')
                        ->where($prefield, 'LIKE', '%'.$query.'%')
                        ->paginate(10);

        return $response;
    }

    public function delete($participant_id)
    {
        $participant = Participant::findOrFail($participant_id);
        $participant->delete();

        return $participant;
    }

}