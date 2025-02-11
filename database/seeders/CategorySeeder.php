<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'nombre' => 'Música',
                'descripcion' => 'Conciertos, festivales y eventos musicales',
                'color' => '#FFA726',
                'icono' => 'fa-music'
            ],
            [
                'nombre' => 'Deportes',
                'descripcion' => 'Eventos deportivos y competencias',
                'color' => '#66BB6A',
                'icono' => 'fa-football-ball'
            ],
            [
                'nombre' => 'Teatro',
                'descripcion' => 'Obras de teatro y espectáculos escénicos',
                'color' => '#AB47BC',
                'icono' => 'fa-theater-masks'
            ],
            [
                'nombre' => 'Arte y Cultura',
                'descripcion' => 'Exposiciones, galerías y eventos culturales',
                'color' => '#26C6DA',
                'icono' => 'fa-palette'
            ],
            [
                'nombre' => 'Gastronomía',
                'descripcion' => 'Ferias gastronómicas y eventos culinarios',
                'color' => '#EF5350',
                'icono' => 'fa-utensils'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}