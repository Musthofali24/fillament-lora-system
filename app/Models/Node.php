<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;

    protected $fillable = [
        'node_id',
        'gateway_id',
        'local_address',
        'spreading_factor',
        'signal_bandwidth',
        'measure_interval',
        'last_seen',
    ];
}
