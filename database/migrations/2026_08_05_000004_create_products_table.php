<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->index();
            $table->longText('description');
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('stock')->default(0);
            $table->string('image_path')->nullable();
            $table->string('video_path')->nullable();
            $table->string('whatsapp_number', 30)->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
