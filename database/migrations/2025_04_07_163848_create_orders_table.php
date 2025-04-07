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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['standard', 'custom'])->default('standard');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('artist_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->text('user_address');
            $table->text('artist_address');
            $table->date('order_date');
            $table->enum('payment_status', ['Payed', 'UnPayed'])->default('UnPayed');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
