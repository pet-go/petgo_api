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
        Schema::create('especies', function (Blueprint $tabela) {
            $tabela->id()->comment('Identificador único');
            $tabela->string('nome')->comment('Nome da espécie');
            $tabela->timestamps();
            $tabela->softDeletes()->comment('Data de remoção da espécie');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especies');
    }
};
