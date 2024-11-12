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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id(); // esto crea un BIGINT UNSIGNED por defecto
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_mascota')->constrained('mascotas')->onDelete('cascade'); // Asegúrate de que ambas columnas sean del mismo tipo
            $table->enum('estado', ['en revisión', 'aprobada', 'rechazada'])->default('en revisión');
            $table->text('comentarios')->nullable();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
