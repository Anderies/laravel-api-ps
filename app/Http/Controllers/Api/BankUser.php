<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class BankUser extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // try catch digunakan untuk menangkap error yang banyak dan tidak kita ketahui
        // if-else digunakan untuk menangkap error yang kita ketahui dan spesifik
        try {
            $jsonContents = public_path('bank_user.json');
            $items = json_decode(file_get_contents($jsonContents), true);


            if (empty($items['data'])) {
                return response()->json(['message' => 'no bank user data found', 'code' => 404], 404);
            }

            if (isset($items['data'])) {
                // dd(1);
                return response()->json($items['data']);
            } else {

                return response()->json(['message' => 'no bank user data found', 'code' => 404], 404);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Error occured ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $jsonContents = public_path('bank_user.json');
            $items = json_decode(file_get_contents($jsonContents), true);


            $newItem = [
                "id" => count($items['data']) + 1,
                "name" => $request->input('name'),
                "date_of_birth" => $request->input('date_of_birth'),
                "email" => $request->input('email'),
                "phone_number" => $request->input('phone_number'),
                "account_number" => $request->input('account_number')
            ];

            $items['data'][] = $newItem;
            file_put_contents($jsonContents, json_encode($items));
            return response()->json(["data" => $newItem, 'code' => 404], 200);
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
        $jsonContents = public_path('bank_user.json');
        $items = json_decode(file_get_contents($jsonContents), true);

        $index = null;

        foreach ($items['data'] as $key => $item) {
            if ($item['user_id'] == $id) {
                $index = $key;
                break;
            }
        }

        if ($index !== null) {
            $fieldsToUpdate = [
                'name', 'date_of_birth',
                'email', 'phone_number', 'account_number'
            ];
            foreach ($fieldsToUpdate as $field) {
                if ($request->has($field)) {
                    $items['data'][$index][$field] = $request->input($field);
                }
            }

            file_put_contents($jsonContents, json_encode($items));

            return response()->json([
                'message' => 'Item Update',
                'data' => $items['data'][$index],
                'code' => 200
            ]);
        }
    }







    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
