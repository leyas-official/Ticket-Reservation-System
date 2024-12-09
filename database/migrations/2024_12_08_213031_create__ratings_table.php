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
        Schema::create('_ratings', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing ID column

            $table->integer('eventId');
            $table->foreign('eventId')->references('id')->on('events')->onDelete('cascade');

            $table->integer('userId');
            $table->foreign('userId')->references('id')->on('customers')->onDelete('cascade');

            $table->string('description');
            $table->timestamps(); // Creates 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_ratings');
    }
};
