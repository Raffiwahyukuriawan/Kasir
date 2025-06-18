<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /*
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_produk' => $this->faker->unique()->word(),
            'barcode' => $this->faker->unique()->ean13(),
            'id_kategori' => rand(1, 15),
            'harga' => $this->faker->randomFloat(2, 1000, 50000),
            'nama_produk' => $this->faker->word(),
            'stok' => $this->faker->numberBetween(10, 100),
        ];
    }
}
