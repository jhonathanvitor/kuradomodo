<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Imagem extends Model
{
    protected $table = 'imagens';
    protected $fillable = ['path', 'filename', 'alt_text', 'mime_type', 'size'];

    // Acessor para pegar a URL completa da imagem
    public function getUrlAttribute() {
        return Storage::url($this->path);
    }
}
