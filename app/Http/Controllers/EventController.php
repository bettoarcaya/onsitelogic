<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests;
use App\Models\Event;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::all();

        return response()->json($events, 200);
    }


}