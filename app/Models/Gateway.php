<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
