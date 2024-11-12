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
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->integer('node_id')->unique();
            $table->integer('gateway_id');
            $table->string('local_address');
            $table->string('gateway_address');
            $table->integer('spreading_factor');
            $table->integer('signal_bandwidth');
            $table->integer('measure_interval');
            $table->float('speedOfSound');
            $table->timestamps();

            $table->foreign('gateway_id')
                ->references('gateway_id')
                ->on('gateways')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodes');
    }
};
