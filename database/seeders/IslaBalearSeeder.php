<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IslaBalearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $islas = [
            ['nombre' => 'Mallorca'],
            ['nombre' => 'Menorca'],
            ['nombre' => 'Ibiza'],
            ['nombre' => 'Formentera'],
            ['nombre' => 'Cabrera'], 
        ];

        foreach ($islas as $isla) {
            DB::table('isla_balears')->insert([
                'nombre' => $isla['nombre'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
