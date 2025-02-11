<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
    public function run()
    {
        Service::create([
            'name' => 'Food & Dining Services',
            'description' => 'Various dining options with special dietary meals.',
            'image' => 'food.jpg',
            'details' => json_encode([
                'In-Room Dining – Private dining in guest rooms.',
                'Hotel Restaurant – On-site dining with a variety of cuisines.',
                'Breakfast Buffet – Complimentary or paid breakfast options.',
                'Catering Services – Food services for events and meetings.',
                'Special Dietary Meals – Vegetarian, gluten-free, and halal options.',
            ]),
        ]);
}
}