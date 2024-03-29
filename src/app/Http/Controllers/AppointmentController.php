<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Schedule;
use Auth;

class AppointmentController extends Controller
{
    public function create(Request $request) 
    {
        $appointment = new Appointment;

        $appointment->patient_id = Auth::user()->id;
        $appointment->patient_name = Auth::user()->name;
        $appointment->schedule_id = $request->schedule_id;
        
        $schedule = Schedule::find($appointment->schedule_id);

        $appointment->schedule = $schedule->schedule;
        
        $appointment->save();


        $schedule->available = false;

        $schedule->save();

        return response()->json(["id" => $appointment->id], 201);
    }

    public function fetchAllActive() 
    {
        return Appointment::where([['is_canceled', false], ['is_done', false]])->get();
    }

    public function fetchAllFinished()
    {
        return Appointment::where('is_done', true)->get();
    }

    public function fetchAllInactive()
    {
        return Appointment::where('is_canceled', true)->get();
    }

    public function fetchByID($appointmentID) 
    {
        return Appointment::where('id', '=', $appointmentID)->first();
    }

    public function fetchByPatientID() 
    {
        return Appointment::where([['patient_id', '=', Auth::user()->id]])->get();
    }

    public function edit(Request $request, $appointmentID) 
    {
        $appointment = Appointment::find($appointmentID);

        $appointment->patient_id = Auth::user()->id;
        $appointment->patient_name = Auth::user()->name;

        if ($appointment->schedule_id != $request->schedule_id) {
            $antiqueSchedule = Schedule::find($appointment->schedule_id);

            $antiqueSchedule->available = true;

            $antiqueSchedule->save();
        }

        $appointment->schedule_id = $request->schedule_id;

        $appointment->save();

        $schedule = Schedule::find($appointment->schedule_id);
        $schedule->available = false;

        $schedule->save();

        return response()->json([], 204);
    }

    public function cancel($appointmentID) 
    {
        $appointment = Appointment::find($appointmentID);

        $appointment->is_canceled = true;

        $appointment->save();

        $schedule = Schedule::find($appointment->schedule_id);

        $schedule->available = true;

        $schedule->save();

        return response()->json([], 204);
    }

    public function markAsDone($appointmentID) 
    {
        $appointment = Appointment::find($appointmentID);

        $appointment->is_done = true;

        $appointment->save();

        return response()->json([], 204);
    }

    public function remove($appointmentID) 
    {
        $appointment = Appointment::find($appointmentID);

        $appointment->delete();

        return response()->json([], 204);
    }
}
