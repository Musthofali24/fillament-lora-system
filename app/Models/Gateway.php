<?php

namespace App\Models;

use App\Models\Node;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'gateway_id',
        'local_address',
        'spreading_factor',
        'signal_bandwidth',
        'measureGateway_interval',
        'configGateway_interval',
        'wifi_ssid',
        'wifi_password',
        'config_gateway_api',
        'config_node_api',
        'sensor_api'
    ];

    // Relasi dengan model NodeConfig
    public function nodes()
    {
        return $this->hasMany(Node::class, 'gateway_id', 'gateway_id');
    }
}
