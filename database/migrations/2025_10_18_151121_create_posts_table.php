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
        Schema::create('posts', function (Blueprint $table) {
           $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->longText('context');
            $table->date('date');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->json('results')->nullable(); // Para armazenar os resultados como JSON
            $table->enum('status', ['draft', 'published', 'archived'])->default('published');
            $table->boolean('featured')->default(false);
            $table->timestamps();

            $table->index('slug');
            $table->index('categoria_id');
            $table->index('status');
            $table->index('featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
