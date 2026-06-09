<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';

    protected $fillable = [
        'nome',
        'descricao',
        'tema',
        'imagem_capa',
        'imagem_logo',
        'usuario_criador_id',
    ];

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

    public function criador()
    {
        return $this->belongsTo(Usuario::class, 'usuario_criador_id');
    }

    public function membros()
    {
        return $this->belongsToMany(Usuario::class, 'grupo_usuario', 'grupo_id', 'usuario_id')
                    ->withPivot(['papel', 'criado_em']);
    }

    public function publicacoes()
    {
        return $this->hasMany(Publicacao::class, 'grupo_id');
    }
}
