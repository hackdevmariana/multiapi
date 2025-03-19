<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ComunidadesAutonomasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comunidades_autonomas')->insert([
            ['nombre' => 'Andalucía'],
            ['nombre' => 'Aragón'],
            ['nombre' => 'Asturias'],
            ['nombre' => 'Baleares'],
            ['nombre' => 'Canarias'],
            ['nombre' => 'Cantabria'],
            ['nombre' => 'Castilla-La Mancha'],
            ['nombre' => 'Castilla y León'],
            ['nombre' => 'Cataluña'],
            ['nombre' => 'Extremadura'],
            ['nombre' => 'Galicia'],
            ['nombre' => 'La Rioja'],
            ['nombre' => 'Madrid'],
            ['nombre' => 'Murcia'],
            ['nombre' => 'Navarra'],
            ['nombre' => 'País Vasco'],
            ['nombre' => 'Valencia'],
        ]);
        
    }
}
