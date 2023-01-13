<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dish::create([
            'category_id' => '1',
            'name_dish' => 'Мясо по французски',
            'composition' => 'Состав',
            'price' => '13790',
            'calories' => 1500.55,
            'img_src' => 'какой-то путь'
        ]);

        Dish::create([
            'category_id' => '3',
            'name_dish' => 'Кола',
            'composition' => 'Состав',
            'price' => '500',
            'calories' => 500,
            'img_src' => 'какой-то путь'
        ]);
    }
}
