<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;

class SpecialtyController extends Controller
{
    public function getByID($specialtyID)
    {
        return  Specialty::where('id', '=', $specialtyID)->first();
    }

    public function get()
    {
        return Specialty::all();
    }

    public function post(Request $request) 
    {
        $specialty = new Specialty;

        $specialty->specialty = $request->specialty;

        $specialty->save();

        return response()->json(["id" => $specialty->id], 201);
    }

    public function put(Request $request, $specialtyID) 
    {
       $specialty = Specialty::find($specialtyID);

       $specialty->specialty = $request->specialty;

       $specialty->save();

       return response()->json([], 204);
    }

    public function delete($specialtyID) {
        $specialty = Specialty::find($specialtyID);

        $specialty->delete();

        return response()->json([], 204);
    }
}
