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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('sr_no')->unique(); // Unique SR Number
            $table->string('name')->nullable();            // Name of the file
            $table->string('category')->nullable();        // Category
            $table->json('meta_tags')->nullable();         // Meta tags (stored as JSON)
            $table->string('file_url')->nullable();        // Auto-generated File URL
            $table->string('file_name')->nullable();       // Original file name
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
