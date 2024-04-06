<?php

use App\Models\Cliente\Cliente;;
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
        Schema::create('pets', function (Blueprint $table) {
            $table->id()->comment('Identificador único da tabela');
            $table->string('nome')->comment('Nome do animal de estimação');
            $table->foreignIdFor(Cliente::class)->comment('Identificador único da tabela de clientes');
            $table->string('especie')->comment('Espécie do pet');
            $table->string('estirpe')->comment('Raça ou estirpe do pet')->nullable();
            $table->date('data_de_nascimento')->comment('Data de nascimento do pet');
            $table->timestamps();
            $table->softDeletes()->comment('Data de remoção do Pet');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
