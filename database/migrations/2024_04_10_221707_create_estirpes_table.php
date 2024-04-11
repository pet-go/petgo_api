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
        Schema::create('estirpes', function (Blueprint $tabela) {
            $tabela->id()->comment('Identificador único');
            $tabela->string('nome')->comment('Nome da estirpe/raça');
            $tabela->foreignId('especie_id')
                ->constrained('especies','id','especie_id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $tabela->timestamps();
            $tabela->softDeletes()->comment('Data de remoção da estirpe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estirpes');
    }
};
