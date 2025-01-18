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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['Portrait', 'Landscape']);
            $table->enum('status',['Sold','Unsold']);
            $table->foreignId('blog_id')->constrained('blogs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('image_id')->constrained('images')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('artist_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained('sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->text('description');
            $table->decimal('price',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
