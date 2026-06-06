<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // ... (outros atributos e métodos do seu modelo) ...

    /**
     * Define a relação de que um Post pertence a uma Imagem.
     */
    public function imagem()
    {
        // Assumindo que o seu modelo de imagem se chama 'Imagem'
        // e a chave estrangeira é 'imagem_id' (como no seu form)
        return $this->belongsTo(Imagem::class, 'imagem_id');
    }
}
