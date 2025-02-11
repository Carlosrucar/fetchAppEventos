<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run()
    {
        DB::table('events')->insert([
            [
                'name' => 'Local Music Festival',
                'description' => 'A vibrant music festival featuring local bands and artists.',
                'date_time' => '2023-09-15 18:00:00',
                'location_id' => 1,
                'category_id' => 1,
                'image' => 'music_festival.jpg',
                'capacity' => 500,
            ],
            [
                'name' => 'Art Exhibition',
                'description' => 'An exhibition showcasing local artists and their works.',
                'date_time' => '2023-09-20 10:00:00',
                'location_id' => 2,
                'category_id' => 2,
                'image' => 'art_exhibition.jpg',
                'capacity' => 200,
            ],
            [
                'name' => 'Food Truck Rally',
                'description' => 'A gathering of the best food trucks in the city.',
                'date_time' => '2023-09-25 12:00:00',
                'location_id' => 3,
                'category_id' => 3,
                'image' => 'food_truck_rally.jpg',
                'capacity' => 300,
            ],
        ]);
    }
}