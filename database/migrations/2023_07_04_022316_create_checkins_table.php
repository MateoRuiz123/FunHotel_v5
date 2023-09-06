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
        Schema::create('checkins', function (Blueprint $table) {
            $table->id();
            // idHabitacion, idServicio, idCliente
            $table->foreignId('idReserva');
            $table->date('fecIngreso');
            $table->integer('estado');
            $table->timestamps();

            $table->foreign('idReserva')
                ->references('id')
                ->on('reservas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checkins', function (Blueprint $table) {
            $table->dropForeign(['idReserva']);
        });
        Schema::dropIfExists('checkins');
    }
};
