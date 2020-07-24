<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use Validator;


class PatientController extends Controller
{
    

    public function index(Request $request){

        try {

            $patients = Patient::get();

            return response()->json($patients);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }

    public function store(Request $request){

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required'
            ]);

            if($validator->fails()){
                return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
            }

            $patient = Patient::create([
                'name' => $request->name,
                'email' => $request->email
            ]);

            return response()->json($patient);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }

    public function update(Request $request, $id){

        try {

            $patient = Patient::find($id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]); 

            return response()->json($patient);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }


    public function destroy($id){

        try {

            $patient = Patient::find($id);
            $patient->delete();

            return response()->json($patient);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }

}
