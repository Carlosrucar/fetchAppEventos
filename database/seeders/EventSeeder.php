<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegurarse de que existen categorías y ubicaciones
        if (Category::count() == 0 || Location::count() == 0) {
            $this->command->error('Necesitas crear categorías y ubicaciones primero');
            return;
        }

        $events = [
            [
                'nombre' => 'Festival de Música en el Parque',
                'descripcion' => 'Gran festival de música al aire libre con artistas locales',
                'fecha' => Carbon::now()->addDays(10),
                'hora_inicio' => '18:00',
                'hora_fin' => '23:00',
                'location_id' => 1,
                'category_id' => 1, // Música
                'imagen' => 'eventos/festival-musica.jpg',
                'capacidad' => 1000,
                'estado' => 'programado'
            ],
            [
                'nombre' => 'Torneo de Fútbol Amateur',
                'descripcion' => 'Competencia deportiva local para equipos amateurs',
                'fecha' => Carbon::now()->addDays(15),
                'hora_inicio' => '09:00',
                'hora_fin' => '18:00',
                'location_id' => 2,
                'category_id' => 2, // Deportes
                'imagen' => 'eventos/torneo-futbol.jpg',
                'capacidad' => 500,
                'estado' => 'programado'
            ],
            [
                'nombre' => 'Exposición de Arte Moderno',
                'descripcion' => 'Muestra de artistas contemporáneos locales',
                'fecha' => Carbon::now()->addDays(5),
                'hora_inicio' => '10:00',
                'hora_fin' => '20:00',
                'location_id' => 3,
                'category_id' => 4, // Arte y Cultura
                'imagen' => 'eventos/expo-arte.jpg',
                'capacidad' => 200,
                'estado' => 'programado'
            ],
            [
                'nombre' => 'Feria Gastronómica Internacional',
                'descripcion' => 'Degustación de platos de diferentes países',
                'fecha' => Carbon::now()->addDays(20),
                'hora_inicio' => '12:00',
                'hora_fin' => '22:00',
                'location_id' => 4,
                'category_id' => 5, // Gastronomía
                'imagen' => 'eventos/feria-gastronomica.jpg',
                'capacidad' => 800,
                'estado' => 'programado'
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}