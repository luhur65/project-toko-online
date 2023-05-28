<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MetodePembayaran>
 */
class MetodePembayaranFactory extends Factory
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
            'kode_metode' => $this->faker->unique()->randomNumber(5),
            'nama_metode' => $this->faker->unique()->randomElement(['BCA', 'BNI', 'BRI', 'Mandiri']),
            'nomor_rekening' => $this->faker->unique()->randomNumber(10),
            'nama_pemilik_rekening' => $this->faker->name(),
            'logo_metode' => $this->faker->unique()->randomElement(['bca.png', 'bni.png', 'bri.png', 'mandiri.png']),
            'is_active' => $this->faker->randomElement(['1', '0']),
            'jenis_metode' => $this->faker->randomElement(['transfer']),
        ];
    }
}
