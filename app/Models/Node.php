<?php

namespace App\Models;

use App\Models\Data;
use App\Models\Gateway;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Node extends Model
{
    use HasFactory;

    protected $fillable = [
        'node_id',
        'gateway_id',
        'local_address',
        'gateway_address',
        'spreading_factor',
        'signal_bandwidth',
        'measure_interval',
        'speedOfSound'
    ];

    // Relasi dengan model GatewayConfig
    public function gateway()
    {
        return $this->belongsTo(Gateway::class, 'gateway_id', 'gateway_id');
    }

    public function sensorData()
    {
        return $this->hasMany(Data::class, 'node_id', 'node_id');
    }
}
