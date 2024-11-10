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
            $table->integer('node_id')->unique(); // Tambahkan unique jika perlu
            $table->foreignId('gateway_id')->constrained('gateways')->onDelete('cascade'); // Menggunakan foreign key
            $table->string('local_address');
            $table->integer('spreading_factor'); // Sesuaikan tipe data
            $table->integer('signal_bandwidth'); // Sesuaikan tipe data
            $table->integer('measure_interval'); // Sesuaikan tipe data
            $table->bigInteger('last_seen'); // Sesuaikan tipe data
            $table->timestamps();
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
