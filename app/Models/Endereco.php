<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'endereco';

    protected $fillable = [
        'endereco',
        'telefone',
        'email',
        'horario_atendimento'
    ];

    public $timestamps = false; // Assuming the table does not have created_at and updated_at columns
}
