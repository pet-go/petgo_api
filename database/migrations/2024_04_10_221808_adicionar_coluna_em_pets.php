<?php

use App\Models\Pet\Estirpe;
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
        Schema::table('pets', function (Blueprint $tabela) {
            $tabela->foreignId('estirpe_id')
                ->after('cliente_id')
                ->comment('Identificador da tabela estripe')
                ->constrained('estirpes', 'id', 'estirpe_id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $tabela) {
            $tabela->dropConstrainedForeignId('estirpe_id');
        });
    }
};
