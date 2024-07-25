<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packets', function (Blueprint $table) {
            $table->uuid('cd_packets')->primary();
            $table->string('packet_name');
            $table->string('description')->nullable();
            $table->string('processing_time');
            $table->decimal('price', 15, 2);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('packets');
    }
};
