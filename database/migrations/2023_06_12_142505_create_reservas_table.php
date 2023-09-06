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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            // idHabitacion, idServicio, idCliente
            $table->foreignId('idHabitacion');
            $table->foreignId('idServicio');
            $table->foreignId('idCliente');
            $table->dateTime('fecIngreso');
            $table->dateTime('fecSalida');
            $table->integer('estado');
            $table->timestamps();

            $table->foreign('idHabitacion')
            ->references('id')
                ->on('habitaciones')
                ->onDelete('cascade');

            $table->foreign('idServicio')
            ->references('id')
                ->on('servicios')
                ->onDelete('cascade');

            $table->foreign('idCliente')
                ->references('id')
                ->on('clientes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropForeign(['idHabitacion']);
            $table->dropForeign(['idServicio']);
            $table->dropForeign(['idCliente']);
        });

        Schema::dropIfExists('reservas');
    }
};
