<?php

namespace App\Models;

use App\Models\Node;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Data extends Model
{
    use HasFactory;

    protected $fillable = [
        'node_id',
        'water_level'
    ];

    public function node()
    {
        return $this->belongsTo(Node::class, 'node_id', 'node_id');
    }
}
