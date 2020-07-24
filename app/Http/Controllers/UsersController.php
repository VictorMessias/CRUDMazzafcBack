<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;


class UsersController extends Controller
{
    

    public function index(Request $request){

        try {

            $users = User::get();

            return response()->json($users);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }

    public function store(Request $request){

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            if($validator->fails()){
                return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
            }

            $user = User::create($request->all());

            return response()->json($user);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }

    public function update(Request $request, $id){

        try {

            $user = User::find($id)->update($request->all());

            return response()->json($user);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }


    public function destroy($id){

        try {

            $user = User::find($id);
            $user->delete();

            return response()->json($user);

        } catch (\Exception $ex) {
            return response()->json(["errors" => $ex->getMessage()], 422);
        }

    }

}
