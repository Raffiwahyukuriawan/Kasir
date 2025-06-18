<?php

namespace Database\Factories;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Transaksi::class;
    public function definition(): array
    {
        return [
            'no_nota' => $this->faker->unique()->ean8(),
            'status' => 'berhasil',
            'tanggal' => '09/02/2025',
            'total_harga' => '50000',
            ''
        ];
    }
}
