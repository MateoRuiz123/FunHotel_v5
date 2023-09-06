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
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id();
            // numeroHabitacion, descripcion, idCategoria, estado
            $table->integer('numeroHabitacion');
            $table->text('descripcion');
            $table->unsignedBigInteger('idCategoria');
            $table->integer('estado')->default(1);
            $table->timestamps();

            $table->foreign('idCategoria')
                ->references('id')
                ->on('categorias')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('habitaciones', function (Blueprint $table) {
            $table->dropForeign(['idCategoria']);
        });

        Schema::dropIfExists('habitaciones');
    }
};
