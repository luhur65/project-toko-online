<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'kode' => fake()->uuid(),
            'nama' => fake()->word(),
            'kategori_id' => fake()->numberBetween(1, 10),
            'harga' => fake()->numberBetween(10000, 100000),
            'stok' => fake()->numberBetween(1, 100),
            'gambar' => fake()->imageUrl(),
            'keterangan' => fake()->text(),
        ];
    }
}
