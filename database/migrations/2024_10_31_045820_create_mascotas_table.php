<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id(); // Crea un campo BIGINT UNSIGNED AUTO_INCREMENT por defecto
            $table->string('nombre');
            $table->integer('edad');
            $table->enum('sexo', ['macho', 'hembra']);
            $table->enum('especie', ['perro', 'gato']);
            $table->enum('tamano', ['Pequeño', 'Mediano', 'Grande']);
            $table->enum('estado_salud', ['Bueno', 'Malo', 'Crítico']);
            $table->enum('estado_adopcion', ['disponible', 'adoptado']);
            $table->text('descripcion');
            $table->string('foto1')->nullable();
            $table->string('foto2')->nullable();
            $table->string('foto3')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};
