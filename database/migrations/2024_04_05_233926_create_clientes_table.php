<?php

use App\Modules\Clientes\Enums\TipoDeGeneroEnum;
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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id()->comment('Identificador único');
            $table->string('nome',100)->comment('Nome do cliente');
            $table->string('nm_reduzido',30)->comment('Nome reduzido do cliente');
            $table->date('data_de_nascimento')->comment('Data de nascimento do cliente')
                ->nullable();
            $table->enum('genero',TipoDeGeneroEnum::obterValores())->comment('Gênero/Sexualidade do cliente')
                ->nullable();
            $table->json('dados_adicionais')->comment('Complementos como cpf,rg e outros dados do gênero')
                ->nullable();
            $table->timestamps();
            $table->softDeletes()->comment('Data de remoção do cliente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
