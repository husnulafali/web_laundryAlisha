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
            $table->datetime('order_date');
            $table->float('weight', 8, 2);
            $table->float('discount', 8, 2)->nullable();
            $table->decimal('total_payment', 15, 2);
            $table->datetime('payment_date')->nullable(); 
            $table->enum('payment_status', ['Belum Lunas', 'Lunas']);
            $table->enum('laundry_status', ['Baru','Pengerjaan','Selesai','di Antar',])->nullable();
            $table->string('note')->nullable();
            $table->text('custom_message')->nullable(); 
            $table->string('message_id')->nullable();
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
