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
        Schema::table('auction_items', function (Blueprint $table) {
            $table->enum('status',['Sold','Unsold'])->default('Unsold');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('auction_items', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
