<?php

use App\Models\Cliente\Cliente;;
use App\Modules\Clientes\Enums\TipoDeContatoEnum;
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
        Schema::create('contatos', function (Blueprint $table) {
            $table->id()->comment('Identificador único da tabela contatos');
            $table->foreignIdFor(Cliente::class)->comment('Identificador do cliente');
            $table->enum('tipo_de_contato',TipoDeContatoEnum::obterValores())->comment('Tipo de contato(e-mail,telefone)');
            $table->boolean('principal')
                ->comment('Define se é o principal contato do cliente')
                ->default(false);
            $table->timestamps();
            $table->softDeletes('Data de remoção');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contatos');
    }
};
