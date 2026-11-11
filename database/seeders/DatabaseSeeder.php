<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\KamarSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
    ['email' => 'admin@kosjos.test'],
    [
        'name' => 'Admin KosJos',
        'password' => 'password',
        'level' => 'admin',
    ]
);
        $this->call(KamarSeeder::class);
    }
}
