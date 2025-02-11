<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            [
                'nombre' => 'Palacio de Congresos',
                'direccion' => 'Paseo del Violón s/n',
                'ciudad' => 'Granada',
                'estado' => 'Granada',
                'codigo_postal' => '18006',
                'latitud' => 37.1656,
                'longitud' => -3.5961,
                'capacidad' => 2000,
                'descripcion' => 'Centro de convenciones y eventos culturales'
            ],
            [
                'nombre' => 'Teatro Isabel la Católica',
                'direccion' => 'Acera del Casino, 7',
                'ciudad' => 'Granada',
                'estado' => 'Granada',
                'codigo_postal' => '18009',
                'latitud' => 37.1744,
                'longitud' => -3.5985,
                'capacidad' => 800,
                'descripcion' => 'Teatro histórico en el centro de Granada'
            ],
            [
                'nombre' => 'Estadio Nuevo Los Cármenes',
                'direccion' => 'Calle Pintor Manuel Maldonado s/n',
                'ciudad' => 'Granada',
                'estado' => 'Granada',
                'codigo_postal' => '18007',
                'latitud' => 37.1530,
                'longitud' => -3.5952,
                'capacidad' => 19336,
                'descripcion' => 'Estadio principal de la ciudad'
            ],
            [
                'nombre' => 'Plaza de Toros de Granada',
                'direccion' => 'Avenida del Doctor Olóriz, 25',
                'ciudad' => 'Granada',
                'estado' => 'Granada',
                'codigo_postal' => '18012',
                'latitud' => 37.1864,
                'longitud' => -3.6011,
                'capacidad' => 14507,
                'descripcion' => 'Monumental plaza de toros para eventos'
            ],
            [
                'nombre' => 'Palacio de Exposiciones y Congresos',
                'direccion' => 'Calle Rey Abu Said s/n',
                'ciudad' => 'Granada',
                'estado' => 'Granada',
                'codigo_postal' => '18006',
                'latitud' => 37.1647,
                'longitud' => -3.5955,
                'capacidad' => 2000,
                'descripcion' => 'Centro moderno para exposiciones y conferencias'
            ]
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}