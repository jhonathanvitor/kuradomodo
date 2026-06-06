<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('imagens', function (Blueprint $table) {
            $table->id();
            $table->string('path'); // Caminho no disco (ex: uploads/imagem-teste.jpg)
            $table->string('filename'); // Nome original do arquivo
            $table->string('alt_text')->nullable(); // Texto alternativo (para SEO)
            $table->string('mime_type')->nullable();
            $table->unsignedInteger('size')->nullable(); // Tamanho em bytes
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('imagens');
    }
};
