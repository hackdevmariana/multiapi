<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IslaCanariasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $islas = [
            ['nombre' => 'El Hierro'],
            ['nombre' => 'La Palma'],
            ['nombre' => 'La Gomera'],
            ['nombre' => 'Tenerife'],
            ['nombre' => 'Gran Canaria'],
            ['nombre' => 'Fuerteventura'],
            ['nombre' => 'Lanzarote'],
            ['nombre' => 'La Graciosa'],
        ];

        foreach ($islas as $isla) {
            DB::table('isla_canarias')->insert([
                'nombre' => $isla['nombre'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
