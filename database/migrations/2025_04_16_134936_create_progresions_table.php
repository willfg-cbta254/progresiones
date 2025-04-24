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
        Schema::create('progresions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('uac',[
                'Humanidades',
                'Ciencias Sociales',
                'Ciencias Naturales, Experimentales y Tecnologicas',
                'Pensamiento Matematico',
                'Lengua y Comunicacion',
                'Conciencia Historica',
                'Cultura Digital',
                'Ingles',
            ]);
            $table->integer('num_progresion');
            $table->string('materia');
            $table->enum('status',['activo','en proceso','concluido'])->default('activo');
            $table->string('documento');
            $table->string('instrumento_evaluacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progresions');
    }
};
