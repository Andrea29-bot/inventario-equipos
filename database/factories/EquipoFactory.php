<?php

namespace Database\Factories;

use App\Models\Equipo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Equipo>
 */
class EquipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'nombre'    => $this->faker->words(2, true),
        'tipo'      => $this->faker->randomElement(['Laptop', 'Proyector', 'Router', 'Impresora']),
        'marca'     => $this->faker->randomElement(['Dell', 'HP', 'Lenovo', 'Epson', 'TP-Link']),
        'estado'    => $this->faker->randomElement(['disponible', 'en_uso', 'mantenimiento']),
        'ubicacion' => $this->faker->randomElement(['Laboratorio 1', 'Laboratorio 2', 'Aula 302']),
    ];
}
}
