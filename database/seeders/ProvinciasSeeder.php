<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProvinciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provincias = [
            ['codigo_provincia' => '01', 'nombre_provincia' => 'Álava', 'codigo_autonomia' => '16', 'comunidad_autonoma' => 'País Vasco', 'capital_provincia' => 'Vitoria-Gasteiz'],
            ['codigo_provincia' => '02', 'nombre_provincia' => 'Albacete', 'codigo_autonomia' => '08', 'comunidad_autonoma' => 'Castilla-La Mancha', 'capital_provincia' => 'Albacete'],
            ['codigo_provincia' => '03', 'nombre_provincia' => 'Alicante', 'codigo_autonomia' => '10', 'comunidad_autonoma' => 'Comunidad Valenciana', 'capital_provincia' => 'Alicante'],
            ['codigo_provincia' => '04', 'nombre_provincia' => 'Almería', 'codigo_autonomia' => '01', 'comunidad_autonoma' => 'Andalucía', 'capital_provincia' => 'Almería'],
            ['codigo_provincia' => '05', 'nombre_provincia' => 'Ávila', 'codigo_autonomia' => '07', 'comunidad_autonoma' => 'Castilla y León', 'capital_provincia' => 'Ávila'],
            ['codigo_provincia' => '06', 'nombre_provincia' => 'Badajoz', 'codigo_autonomia' => '11', 'comunidad_autonoma' => 'Extremadura', 'capital_provincia' => 'Badajoz'],
            ['codigo_provincia' => '07', 'nombre_provincia' => 'Islas Baleares', 'codigo_autonomia' => '04', 'comunidad_autonoma' => 'Islas Baleares', 'capital_provincia' => 'Palma de Mallorca'],
            ['codigo_provincia' => '08', 'nombre_provincia' => 'Barcelona', 'codigo_autonomia' => '09', 'comunidad_autonoma' => 'Cataluña', 'capital_provincia' => 'Barcelona'],
            ['codigo_provincia' => '09', 'nombre_provincia' => 'Burgos', 'codigo_autonomia' => '07', 'comunidad_autonoma' => 'Castilla y León', 'capital_provincia' => 'Burgos'],
            ['codigo_provincia' => '10', 'nombre_provincia' => 'Cáceres', 'codigo_autonomia' => '11', 'comunidad_autonoma' => 'Extremadura', 'capital_provincia' => 'Cáceres'],
            ['codigo_provincia' => '11', 'nombre_provincia' => 'Cádiz', 'codigo_autonomia' => '01', 'comunidad_autonoma' => 'Andalucía', 'capital_provincia' => 'Cádiz'],
            ['codigo_provincia' => '12', 'nombre_provincia' => 'Castellón', 'codigo_autonomia' => '10', 'comunidad_autonoma' => 'Comunidad Valenciana', 'capital_provincia' => 'Castellón de la Plana'],
            ['codigo_provincia' => '13', 'nombre_provincia' => 'Ciudad Real', 'codigo_autonomia' => '08', 'comunidad_autonoma' => 'Castilla-La Mancha', 'capital_provincia' => 'Ciudad Real'],
            ['codigo_provincia' => '14', 'nombre_provincia' => 'Córdoba', 'codigo_autonomia' => '01', 'comunidad_autonoma' => 'Andalucía', 'capital_provincia' => 'Córdoba'],
            ['codigo_provincia' => '15', 'nombre_provincia' => 'A Coruña', 'codigo_autonomia' => '06', 'comunidad_autonoma' => 'Galicia', 'capital_provincia' => 'A Coruña'],
            ['codigo_provincia' => '16', 'nombre_provincia' => 'Cuenca', 'codigo_autonomia' => '08', 'comunidad_autonoma' => 'Castilla-La Mancha', 'capital_provincia' => 'Cuenca'],
            ['codigo_provincia' => '17', 'nombre_provincia' => 'Girona', 'codigo_autonomia' => '09', 'comunidad_autonoma' => 'Cataluña', 'capital_provincia' => 'Girona'],
            ['codigo_provincia' => '18', 'nombre_provincia' => 'Granada', 'codigo_autonomia' => '01', 'comunidad_autonoma' => 'Andalucía', 'capital_provincia' => 'Granada'],
            ['codigo_provincia' => '19', 'nombre_provincia' => 'Guadalajara', 'codigo_autonomia' => '08', 'comunidad_autonoma' => 'Castilla-La Mancha', 'capital_provincia' => 'Guadalajara'],
            ['codigo_provincia' => '20', 'nombre_provincia' => 'Gipuzkoa', 'codigo_autonomia' => '16', 'comunidad_autonoma' => 'País Vasco', 'capital_provincia' => 'San Sebastián'],
            ['codigo_provincia' => '21', 'nombre_provincia' => 'Huelva', 'codigo_autonomia' => '01', 'comunidad_autonoma' => 'Andalucía', 'capital_provincia' => 'Huelva'],
            ['codigo_provincia' => '22', 'nombre_provincia' => 'Huesca', 'codigo_autonomia' => '02', 'comunidad_autonoma' => 'Aragón', 'capital_provincia' => 'Huesca'],
            ['codigo_provincia' => '23', 'nombre_provincia' => 'Jaén', 'codigo_autonomia' => '01', 'comunidad_autonoma' => 'Andalucía', 'capital_provincia' => 'Jaén'],
            ["codigo_provincia" => "24","nombre_provincia" => "León","codigo_autonomia" => "07","comunidad_autonoma" => "Castilla y León","capital_provincia" => "León"], 
            ["codigo_provincia" => "25","nombre_provincia" => "Lérida/Lleida","codigo_autonomia" => "09","comunidad_autonoma" => "Cataluña\/Catalunya","capital_provincia" => "Lleida"],
            ["codigo_provincia" => "26", "nombre_provincia" => "La Rioja", "codigo_autonomia" => "17","comunidad_autonoma" => "La Rioja", "capital_provincia" => "Logroño"],
            ["codigo_provincia" => "27","nombre_provincia" => "Lugo","codigo_autonomia" => "12","comunidad_autonoma" => "Galicia","capital_provincia" => "Lugo"],
            ["codigo_provincia" => "28","nombre_provincia" => "Madrid","codigo_autonomia" => "13","comunidad_autonoma" => "Comunidad de Madrid","capital_provincia" => "Madrid"],
            ["codigo_provincia" => "29","nombre_provincia" => "Málaga","codigo_autonomia" => "01","comunidad_autonoma" => "Andalucía","capital_provincia" => "Málaga"], 
            ["codigo_provincia" => "30","nombre_provincia" => "Murcia","codigo_autonomia" => "14","comunidad_autonoma" => "Región de Murcia","capital_provincia" => "Murcia"],
            ["codigo_provincia" => "31","nombre_provincia" => "Navarra","codigo_autonomia" => "15","comunidad_autonoma" => "Comunidad Foral de Navarra","capital_provincia" => "Pamplona\/Iruña"],
            ["codigo_provincia" => "32","nombre_provincia" => "Ourense","codigo_autonomia" => "12","comunidad_autonoma" => "Galicia","capital_provincia" => "Ourense"],
            ["codigo_provincia" => "33","nombre_provincia" => "Asturias", "codigo_autonomia" => "03", "comunidad_autonoma" => "Principado de Asturias", "capital_provincia" => "Oviedo"],
            ["codigo_provincia" => "34","nombre_provincia" => "Palencia","codigo_autonomia" => "07","comunidad_autonoma" => "Castilla y León","capital_provincia" => "Palencia"],
            ["codigo_provincia" => "35","nombre_provincia" => "Las Palmas","codigo_autonomia" => "05","comunidad_autonoma" => "Canarias","capital_provincia" => "Las Palmas de Gran Canaria"],
            ["codigo_provincia" => "36","nombre_provincia" => "Pontevedra","codigo_autonomia" => "12","comunidad_autonoma" => "Galicia","capital_provincia" => "Pontevedra"],
            ["codigo_provincia" => "37","nombre_provincia" => "Salamanca","codigo_autonomia" => "07","comunidad_autonoma" => "Castilla y León","capital_provincia" => "Salamanca"],
            ["codigo_provincia" => "38","nombre_provincia" => "Santa Cruz de Tenerife","codigo_autonomia" => "05","comunidad_autonoma" => "Canarias","capital_provincia" => "Santa Cruz de Tenerife"],
            ["codigo_provincia" => "39", "nombre_provincia" => "Cantabria", "codigo_autonomia" => "06","comunidad_autonoma" => "Cantabria","capital_provincia" => "Santander"], 
            ["codigo_provincia" => "40","nombre_provincia" => "Segovia","codigo_autonomia" => "07","comunidad_autonoma" => "Castilla y León","capital_provincia" => "Segovia"],
            ["codigo_provincia" => "41","nombre_provincia" => "Sevilla","codigo_autonomia" => "01","comunidad_autonoma" => "Andalucía","capital_provincia" => "Sevilla"],
            ["codigo_provincia" => "42","nombre_provincia" => "Soria","codigo_autonomia" => "07","comunidad_autonoma" => "Castilla y León","capital_provincia" => "Soria"],
            ["codigo_provincia" => "43","nombre_provincia" => "Tarragona","codigo_autonomia" => "09","comunidad_autonoma" => "Cataluña\/Catalunya","capital_provincia" => "Tarragona"],
            ["codigo_provincia" => "44","nombre_provincia" => "Teruel","codigo_autonomia" => "02","comunidad_autonoma" => "Aragón","capital_provincia" => "Teruel"],
            ["codigo_provincia" => "45","nombre_provincia" => "Toledo","codigo_autonomia" => "08","comunidad_autonoma" => "Castilla-La Mancha","capital_provincia" => "Toledo"],
            ["codigo_provincia" => "46","nombre_provincia" => "Valencia","codigo_autonomia" => "10","comunidad_autonoma" => "Comunitat Valenciana","capital_provincia" => "Valencia"],
            ["codigo_provincia" => "47","nombre_provincia" => "Valladolid","codigo_autonomia" => "07","comunidad_autonoma" => "Castilla y León","capital_provincia" => "Valladolid"],
            ["codigo_provincia" => "48", "nombre_provincia" => "Bizkaia", "codigo_autonomia" => "16","comunidad_autonoma" => "Pa\u00eds Vasco\/Euskadi","capital_provincia" => "Bilbao"],
            ["codigo_provincia" => "49","nombre_provincia" => "Zamora","codigo_autonomia" => "07","comunidad_autonoma" => "Castilla y León","capital_provincia" => "Zamora"],
            ["codigo_provincia" => "50","nombre_provincia" => "Zaragoza","codigo_autonomia" => "02","comunidad_autonoma" => "Aragón","capital_provincia" => "Zaragoza"],
            ["codigo_provincia" => "51", "nombre_provincia" => "Ceuta", "codigo_autonomia" => "18","comunidad_autonoma" => "Ciudad Autónoma de Ceuta","capital_provincia" => "Ceuta"], 
            ["codigo_provincia" => "52","nombre_provincia" => "Melilla","codigo_autonomia" => "19","comunidad_autonoma" => "Ciudad Autónoma de Melilla","capital_provincia" => "Melilla"],
            
        ];

        foreach ($provincias as $provincia) {
            DB::table('provincias')->insert([
                'codigo_provincia' => $provincia['codigo_provincia'],
                'nombre_provincia' => $provincia['nombre_provincia'],
                'codigo_autonomia' => $provincia['codigo_autonomia'],
                'comunidad_autonoma' => $provincia['comunidad_autonoma'],
                'capital_provincia' => $provincia['capital_provincia'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
    }
}
