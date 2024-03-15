<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BankUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $users = BankUser::all();
        return $this->sendResponse($users, "Data loaded successfully!");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'date_of_birth' => 'required|date',
                'email' => 'required|unique:bankuser',
                'phone_number' => 'required'
            ]);

            if ($validator->fails()) {
                $error = $validator->errors();
                return $this->sendError($error, "Please check your input.");
            }

            // Insert data to Database using Eloquent
            return BankUser::create($request->all());
        } catch (Exception $e) {
            return response()->json(['message' => 'Error occured ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $user = BankUser::findOrFail($id);
            $user->update($request->all());
            return $user;
        } catch (Exception $e) {
            return response()->json(['message' => 'Error occured ' . $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try{
            $validator = Validator::make(['id' => $id],[
                'id' => 'required|exists:bankuser,user_id'
            ]);

            if($validator->fails()){
                return response()->json(['error' => $validator->errors()]);
            }

            $user = BankUser::findOrFail($id);
            // delete user
            $user->delete();
            return response()->json(['message' =>
            "$user->user_id user is deleted sucessfully"]);

        }catch(Exception $e){
            return response()->json(['message' => 'Error occured ' . $e->getMessage()], 500);
        }
    }
}
