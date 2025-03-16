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
        Schema::create('api_documentation', function (Blueprint $table) {
            $table->id();
            $table->string('route');
            $table->text('description');
            $table->text('example')->nullable();
            $table->string('language')->default('en'); // Para multiidioma
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_documentations');
    }
};
