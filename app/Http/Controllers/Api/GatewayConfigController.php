<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GatewayConfigController extends Controller
{
    public function getConfig(Request $request)
    {
        if ($request->has('gateway_id')) {
            $gateway = Gateway::where('gateway_id', $request->gateway_id)->get();
            return response()->json($gateway);
        }

        $gateways = Gateway::all();
        return response()->json($gateways);
    }

    public function updateConfig(Request $request)
    {
        $input = $request->all();

        // Single data
        if (isset($input['gateway_id'])) {
            return $this->processSingleGateway($input);
        }

        // Multiple data
        return $this->processMultipleGateways($input);
    }

    private function processSingleGateway($data)
    {
        $validator = Validator::make($data, [
            'gateway_id' => 'required|integer',
            'local_address' => 'required|string',
            'spreading_factor' => 'required|integer',
            'signal_bandwidth' => 'required|integer',
            'measureGateway_interval' => 'required|integer',
            'configGateway_interval' => 'required|integer',
            'wifi_ssid' => 'required|string',
            'wifi_password' => 'required|string',
            'config_gateway_api' => 'required|string',
            'config_node_api' => 'required|string',
            'sensor_api' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        $gateway = Gateway::where('gateway_id', $data['gateway_id'])->first();

        if ($gateway) {
            $gateway->update($data);
        } else {
            Gateway::create($data);
        }

        return response()->json(['message' => 'Data stored successfully'], 201);
    }

    private function processMultipleGateways($dataArray)
    {
        foreach ($dataArray as $data) {
            $validator = Validator::make($data, [
                'gateway_id' => 'required|integer',
                'local_address' => 'required|string',
                'spreading_factor' => 'required|integer',
                'signal_bandwidth' => 'required|integer',
                'measureGateway_interval' => 'required|integer',
                'configGateway_interval' => 'required|integer',
                'wifi_ssid' => 'required|string',
                'wifi_password' => 'required|string',
                'config_gateway_api' => 'required|string',
                'config_node_api' => 'required|string',
                'sensor_api' => 'required|string'
            ]);

            if ($validator->fails()) {
                continue;
            }

            $gateway = Gateway::where('gateway_id', $data['gateway_id'])->first();

            if ($gateway) {
                $gateway->update($data);
            } else {
                Gateway::create($data);
            }
        }

        return response()->json(['message' => 'Data stored successfully'], 201);
    }
}
