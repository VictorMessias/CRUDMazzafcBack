<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use Validator;


class AgendaController extends Controller
{
    

    public function index(Request $request){

        try {

            $agenda = Agenda::with(['patient', 'doctor'])->get();

            return response()->json($agenda);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }

    public function store(Request $request){

        try {
            $validator = Validator::make($request->all(), [
                'doctor_id' => 'required',
                'patient_id' => 'required',
                'date' => 'required'
            ]);

            if($validator->fails()){
                return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
            }

            $agenda = Agenda::create([
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->patient_id,
                'date' => $request->date
            ]);

            return response()->json($agenda);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }

    public function update(Request $request, $id){

        try {

            $agenda = Agenda::find($id)->update([
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->patient_id,
                'date' => $request->date
            ]); 

            return response()->json($agenda);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }


    public function destroy($id){

        try {

            $agenda = Agenda::find($id);
            $agenda->delete();

            return response()->json($agenda);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }

}
