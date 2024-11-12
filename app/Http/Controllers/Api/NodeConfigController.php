<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Node;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NodeConfigController extends Controller
{
    public function getConfigs(Request $request)
    {
        if ($request->has('node_id')) {
            $node = Node::where('node_id', $request->node_id)->get();
            return response()->json($node);
        }

        if ($request->has('gateway_id')) {
            $nodes = Node::where('gateway_id', $request->gateway_id)->get();
            return response()->json($nodes);
        }

        $nodes = Node::all();
        return response()->json($nodes);
    }

    public function updateConfig(Request $request)
    {
        $input = $request->all();

        // Single data
        if (isset($input['node_id'])) {
            return $this->processSingleNode($input);
        }

        // Multiple data
        return $this->processMultipleNodes($input);
    }

    private function processSingleNode($data)
    {
        $validator = Validator::make($data, [
            'node_id' => 'required|integer',
            'gateway_id' => 'required|integer|exists:gateway_configs,gateway_id',
            'local_address' => 'required|string',
            'gateway_address' => 'required|string',
            'spreading_factor' => 'required|integer',
            'signal_bandwidth' => 'required|integer',
            'measure_interval' => 'required|integer',
            'speedOfSound' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        $node = Node::where('node_id', $data['node_id'])->first();

        if ($node) {
            $node->update($data);
        } else {
            Node::create($data);
        }

        return response()->json(['message' => 'Data stored successfully'], 201);
    }

    private function processMultipleNodes($dataArray)
    {
        foreach ($dataArray as $data) {
            $validator = Validator::make($data, [
                'node_id' => 'required|integer',
                'gateway_id' => 'required|integer|exists:gateway_configs,gateway_id',
                'local_address' => 'required|string',
                'gateway_address' => 'required|string',
                'spreading_factor' => 'required|integer',
                'signal_bandwidth' => 'required|integer',
                'measure_interval' => 'required|integer',
                'speedOfSound' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                continue;
            }

            $node = Node::where('node_id', $data['node_id'])->first();

            if ($node) {
                $node->update($data);
            } else {
                Node::create($data);
            }
        }

        return response()->json(['message' => 'Data stored successfully'], 201);
    }
}
