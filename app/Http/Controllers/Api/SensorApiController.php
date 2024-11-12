<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SensorApiController extends Controller
{
    public function getSensorData(Request $request)
    {
        if ($request->has('node_id')) {
            $data = Data::where('node_id', $request->node_id)->get();
            return response()->json($data);
        }

        $data = Data::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        // Validasi format input
        if (!is_array($request->all())) {
            return response()->json(['message' => 'Invalid data format'], 422);
        }

        // Jika data tunggal (bukan array di level pertama)
        if (isset($request->node_id)) {
            $validator = Validator::make($request->all(), [
                'node_id' => 'required|integer|exists:node_configs,node_id',
                'water_level' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()], 422);
            }

            $sensorData = Data::create($request->all());
            return response()->json($sensorData, 201);
        }

        // Untuk multiple data
        foreach ($request->all() as $data) {
            $validator = Validator::make($data, [
                'node_id' => 'required|integer|exists:node_configs,node_id',
                'water_level' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                continue; // Skip data yang tidak valid
            }

            Data::create($data);
        }

        return response()->json(['message' => 'Data stored successfully'], 201);
    }
}
