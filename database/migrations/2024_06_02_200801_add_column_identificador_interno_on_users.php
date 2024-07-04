<?php

use App\Modules\Auth\Enums\AuthEnum;
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
        Schema::table('usuarios', function (Blueprint $tabela) {
            $tabela->string('identificador_interno', 60)
                ->comment('Identifica o tipo de usuário')
                ->default(AuthEnum::CLIENTE)
                ->after('email');
            $tabela->unsignedBigInteger('cliente_id')
                ->nullable()
                ->comment('Identificador interno de clientes')
                ->after('identificador_interno');
            $tabela->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $tabela) {
            $tabela->dropColumn('identificador_interno');
            $tabela->dropForeign('users_cliente_id_foreign');
            $tabela->dropIndex('users_cliente_id_foreign');
            $tabela->dropColumn('cliente_id');
        });
    }
};
