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
        Schema::create('sports', function (Blueprint $table) {
            $table->id('eventId');  // auto-incrementing ID

            // Other columns for the event type movie
            $table->string('stadium',);
            $table->string('homeTeam');
            $table->string('awayTeam');
            $table->string('typeOfSport');
            $table->time('length');

            $table->foreign('eventId')->references('id')->on('events')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
