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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            // fecha_venta, idServicio, estado
            $table->date('fecha_venta');
            $table->unsignedBigInteger('idReserva');
            $table->Integer('estado')->default(1);
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
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropForeign(['idReserva']);
        });

        Schema::dropIfExists('ventas');
    }
};
