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
        $appointment->schedule_id = $request->schedule_id;

        $appointment->save();

        $schedule = Schedule::find($appointment->schedule_id);

        $schedule->available = false;

        $schedule->save();

        return response()->json(["id" => $appointment->id], 201);
    }

    public function fetchAll() 
    {
        return Appointment::where('is_canceled', false)->get();
    }

    public function fetchByID($appointmentID) 
    {
        return Appointment::where('id', '=', $appointmentID)->first();
    }

    public function edit(Request $request, $appointmentID) 
    {
        $appointment = Appointment::find($appointmentID);

        $appointment->patient_id = Auth::user()->id;

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

    public function remove($appointmentID) 
    {
        $appointment = Appointment::find($appointmentID);

        $appointment->delete();

        return response()->json([], 204);
    }
}
