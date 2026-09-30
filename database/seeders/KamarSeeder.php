<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Kamar::create([
                'nomor_kamar' => 'K' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'tipe_kamar' => fake()->randomElement([
                    'Standard',
                    'Deluxe'
                ]),
                'harga' => fake()->numberBetween(100000, 500000),
                'fasilitas' => fake()->randomElement([
                    'AC, TV, WiFi',
                    'AC, TV, WiFi, Kamar Mandi Dalam'
                ]),
                'status' => fake()->randomElement([
                    'Tersedia',
                    'Terisi'
                ]),
            ]);
        }
    }
}