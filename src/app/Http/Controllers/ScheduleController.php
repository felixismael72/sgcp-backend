<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Auth;

class ScheduleController extends Controller
{   
    public function fetchByID($scheduleID)
    {
        return  Schedule::where('id', '=', $scheduleID)->first();
    }

    public function fetchAll()
    {
        return Schedule::where('available', true)->get();
    }

    public function create(Request $request) 
    {
        $schedule = new Schedule;

        $schedule->schedule = $request->schedule;
        $schedule->psychologist_id = Auth::user()->id;
        $schedule->expired = $request->expired;

        $schedule->save();

        return response()->json(["id" => $schedule->id], 201);
    }

    public function edit(Request $request, $scheduleID) 
    {
       $schedule = Schedule::find($scheduleID);

       $schedule->schedule = $request->schedule;
       $schedule->psychologist_id = Auth::user()->id;
       $schedule->expired = $request->expired;

       $schedule->save();

       return response()->json([], 204);
    }

    public function remove($scheduleID) {
        $schedule = Schedule::find($scheduleID);

        $schedule->delete();

        return response()->json([], 204);
    }
}
