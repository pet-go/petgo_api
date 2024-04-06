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
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id()->comment('Identificador único');
            $table->foreignIdFor(Cliente::class);
            $table->string('logradouro')->comment('Rua ou avenida');
            $table->smallInteger('numero')->comment('Número da residência/logradouro');
            $table->string('bairro')->comment('Bairro do cliente');
            $table->string('cidade')->comment('Cidade do cliente');
            $table->boolean('mora_fora_do_pais')->comment('Identifica se o cliente reside mora do pais')->default(false);
            $table->string('pais')->comment('Preencher caso o cliente more fora do Brasil')->nullable();
            $table->timestamps();
            $table->softDeletes()->comment('Data de remoção');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};
