<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('historial_vista', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('cita_id')->constrained('citas')->onDelete('cascade');
            $table->decimal('eje');
            $table->decimal('cilindro');
            $table->decimal('esfera');
            $table->string('documentacion')->nullable();
            $table->softDeletes(); // Para borrar lógicamente
            $table->timestamps(); // Para registrar cuándo se añadió cada dato
        });
    }

    public function down()
    {
        Schema::dropIfExists('historial_vista');
    }
};
