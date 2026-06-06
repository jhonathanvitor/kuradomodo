<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('posts', function (Blueprint $table) {
            // 1. Remove a coluna antiga 'image'
            $table->dropColumn('image');

            // 2. Adiciona a nova coluna de chave estrangeira
            $table->foreignId('imagem_id')
                  ->nullable() // Permite post sem imagem
                  ->after('categoria_id') // Posição no banco
                  ->constrained('imagens') // Aponta para a tabela 'imagens'
                  ->onDelete('set null'); // Se a imagem for deletada, o post não é deletado
        });
    }
    public function down(): void {
        Schema::table('posts', function (Blueprint $table) {
            // Reverte as mudanças
            $table->dropForeign(['imagem_id']);
            $table->dropColumn('imagem_id');
            $table->string('image')->nullable(); // Adiciona a coluna antiga de volta
        });
    }
};
