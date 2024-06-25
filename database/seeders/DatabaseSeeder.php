<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kriteria;
use App\Models\supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Kriteria::create([
            'nama_kriteria' => 'kualitas'
        ]);
        Kriteria::create([
            'nama_kriteria' => 'harga'
        ]);
        Kriteria::create([
            'nama_kriteria' => 'pelayanan'
        ]);
        Kriteria::create([
            'nama_kriteria' => 'pengiriman'
        ]);
    }

}
