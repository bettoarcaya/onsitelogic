<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\ParticipantRepository;
use App\Http\Requests\StoreParticipant;
use App\Http\Requests\UpdateParticipant;
use Illuminate\Support\Str;

class ParticipantController extends Controller
{

    protected $participant_repository;

    public function __construct(
        ParticipantRepository $participantRepository
    ){
        $this->participant_repository = $participantRepository;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getParticipants(){

        $participants = $this->participant_repository->getAll();
        
        $data = compact('participants');

        return response()->json($data, 200);
    }

    public function participantTypes(){
        
        $types = $this->participant_repository->getAllTypes();
        
        $data = compact('types');

        return response()->json($data, 200);
    }

    public function search(Request $request)
    {
        $query = $request['search'];
        $field =  ( count($request['filterBy']) > 0 ) 
               ? $request['filterBy']['id']
               : 'name';
        
        $participants = $this->participant_repository->search($field, $query);

        $data = compact('participants');
        
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParticipant $request)
    {
        $data = [
          'name' => $request->name,
          'lastname' => $request->lastname,
          'email' => $request->email,
          'type' => $request->type['id'],
          'assistance' => false,
          'participant_id' => Str::random(12),
          'id_number' => intval($request->id_number),
          'born_date' => $request->born_date,
          'address' => $request->address,
          'phone' => $request->phone
        ];

        $participant = $this->participant_repository->add($data);
        $event = $this->participant_repository->addEvent($participant->id, $request->event['id']);
        
        $response = compact('participant', 'event');

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $participant = $this->participant_repository->getParticipant($id);

        $data = compact('participant');

        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParticipant $request, $id)
    {
        $data = [
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'id_number' => intval($request->id_number),
            'born_date' => $request->born_date,
            'address' => $request->address,
            'phone' => $request->phone
        ];

        $participant = $this->participant_repository->update($data, $id);

        $response = compact('participant');

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(200);
    }
}
