<?php

namespace Database\Factories;

use App\Models\Perfil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Perfil>
 */
class PerfilFactory extends Factory
{
    protected $model = Perfil::class;

    public function definition(): array
    {
        return [
            'nome' => fake()->unique()->randomElement(['Administrador', 'Usuario', 'Moderador']) . ' ' . fake()->unique()->numberBetween(1, 9999),
        ];
    }
}
