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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
            $table->time('time');
            $table->float('price');
            $table->string('description');
            $table->integer('numberOfTicket');
            $table->float('discount', 5, 2);

            // ? Define Foreign Key => LocationID
            $table->unsignedBigInteger('locationId');
            $table->foreign('locationId')->references('id')->on('locations')->onDelete('cascade');

            // ? Define Foreign Key => EventTypeId
            $table->unsignedBigInteger('eventTypeId');
            $table->foreign('eventTypeId')->references('id')->on('event_types')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
