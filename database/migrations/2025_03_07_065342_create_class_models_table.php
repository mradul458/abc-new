<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {  // Change table name to 'classes'
            $table->id();
            $table->string('name'); // Class name
            $table->date('start_date'); // Class start date
            $table->date('end_date'); // Class end date
            $table->integer('capacity'); // Class capacity
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes'); // Drop the correct table
    }
};



