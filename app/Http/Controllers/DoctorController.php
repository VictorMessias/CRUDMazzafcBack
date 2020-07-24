<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use Validator;


class DoctorController extends Controller
{
    

    public function index(Request $request){

        try {

            $doctors = Doctor::get();

            return response()->json($doctors);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }

    public function store(Request $request){

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'crm' => 'required'
            ]);

            if($validator->fails()){
                return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
            }

            $doctor = Doctor::create([
                'name' => $request->name,
                'email' => $request->email,
                'crm' => $request->crm
            ]);

            return response()->json($doctor);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }

    public function update(Request $request, $id){

        try {

            $doctor = Doctor::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'crm' => $request->crm
            ]); 

            return response()->json($doctor);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }


    public function destroy($id){

        try {

            $doctor = Doctor::find($id);
            $doctor->delete();

            return response()->json($doctor);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }

}
