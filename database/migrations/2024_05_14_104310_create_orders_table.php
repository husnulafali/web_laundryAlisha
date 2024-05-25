<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('cd_orders')->primary(); 
            $table->uuid('cd_customers');
            $table->uuid('cd_packets');
            $table->date('order_date');
            $table->float('weight', 8, 2);
            $table->float('discount', 8, 2)->nullable();
            $table->float('total_payment', 8, 2);
            $table->date('payment_date')->nullable(); 
            $table->enum('payment_status', ['Belum Lunas', 'Lunas']);
            $table->enum('laundry_status', ['Baru','Dalam Pengerjaan','Laundry Selesai','di Antar',])->nullable();
            $table->string('note')->nullable();
            $table->foreign('cd_customers')->references('cd_customers')->on('customers')->onDelete('cascade');
            $table->foreign('cd_packets')->references('cd_packets')->on('packets')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
