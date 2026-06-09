<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'perfil_id',
    ];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    protected $casts = [];

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function setSenhaAttribute($value)
    {
        $this->attributes['senha'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'grupo_usuario', 'usuario_id', 'grupo_id')
                    ->withPivot(['papel', 'criado_em']);
    }

    public function publicacoes()
    {
        return $this->hasMany(Publicacao::class, 'usuario_id');
    }
}
