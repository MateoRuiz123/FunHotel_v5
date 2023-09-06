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
        Schema::create('ventas_servicios', function (Blueprint $table) {
            $table->id();
            // llaves foraneas bitint a ventas y servicios
            $table->unsignedBigInteger('venta_id');
            $table->unsignedBigInteger('servicio_id');
            $table->timestamps();

            $table->foreign('venta_id')
                ->references('id')
                ->on('ventas')
                ->onDelete('cascade');

            $table->foreign('servicio_id')
                ->references('id')
                ->on('servicios')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ventas_servicios', function (Blueprint $table) {
            $table->dropForeign(['venta_id']);
            $table->dropForeign(['servicio_id']);
        });
        Schema::dropIfExists('ventas_servicios');
    }
};
