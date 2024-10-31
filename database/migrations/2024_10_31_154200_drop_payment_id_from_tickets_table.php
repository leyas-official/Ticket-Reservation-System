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
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['paymentId']);
            $table->dropColumn('paymentId');
            $table->string('paymentType');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Add the old column back with the foreign key constraint if needed
            $table->unsignedBigInteger('paymentId')->nullable(); // Adjust the type as needed

            // Recreate the foreign key constraint if necessary
            $table->foreign('paymentId')->references('id')->on('payments')->onDelete('cascade'); // Adjust to your foreign key reference
        });
    }
};
