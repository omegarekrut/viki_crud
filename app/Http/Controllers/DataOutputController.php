<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataOutput;

class DataOutputController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $data = DataOutput::where('user_id', $userId)->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function delete(Request $request)
    {
        $userId = auth()->user()->id;
        $idRow = $request->input('id_row');
        $data = DataOutput::where('user_id', $userId)
            ->where('id', $idRow)
            ->first();
        if ($data) {
            $data->delete();
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'error' => 'Record not found',
            ]);
        }
    }

    public function edit(Request $request)
    {
        $userId = auth()->user()->id;
        $idRow = $request->input('id_row');
        $json = $request->input('json');
        $updatedAt = $request->input('updated_at');

        $data = DataOutput::where('user_id', $userId)
            ->where('id', $idRow)
            ->first();

        if ($data) {
            // Update the JSON data
            $data->json = $json;

            // Set the updated_at timestamp
            $data->updated_at = $updatedAt;

            $data->save();

            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'error' => 'Record not found',
            ]);
        }
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $json = $request->input('json');

        $data = new DataOutput();
        $data->user_id = $userId;
        $json = json_encode($data);
        $data->json = $json;
        $data->created_at = now();
        $data->save();

        return response()->json([
            'success' => true,
        ]);
    }
}
