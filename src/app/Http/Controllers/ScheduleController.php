<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{   
    public function getByID($scheduleID)
    {
        return  Schedule::where('id', '=', $scheduleID)->first();
    }

    public function get()
    {
        return Schedule::all();
    }

    public function post(Request $request) 
    {
        $schedule = new Schedule;

        $schedule->schedule = $request->schedule;
        $schedule->expired = $request->expired;

        $schedule->save();

        return response()->json(["id" => $schedule->id], 201);
    }

    public function put(Request $request, $scheduleID) 
    {
       $schedule = Schedule::find($scheduleID);

       $schedule->schedule = $request->schedule;
       $schedule->expired = $request->expired;

       $schedule->save();

       return response()->json([], 204);
    }

    public function delete($scheduleID) {
        $schedule = Schedule::find($scheduleID);

        $schedule->delete();

        return response()->json([], 204);
    }
}
