<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->integer('gateway_id')->unique();
            $table->string('local_address');
            $table->integer('spreading_factor');
            $table->integer('signal_bandwidth');
            $table->integer('measureGateway_interval');
            $table->integer('configGateway_interval');
            $table->string('wifi_ssid')->required();
            $table->string('wifi_password')->required();
            $table->string('config_gateway_api')->required();
            $table->string('config_node_api')->required();
            $table->string('sensor_api')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gateways');
    }
};
