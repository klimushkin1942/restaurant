<?php

namespace Database\Seeders;

use App\Models\CategoryMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryMenu::create([
            'category_name' => 'Горячее',
            'img_src' => 'путь к картинке',
        ]);

        CategoryMenu::create([
            'category_name' => 'Холодное',
            'img_src' => 'путь к картинке',
        ]);

        CategoryMenu::create([
            'category_name' => 'Напитки',
            'img_src' => 'путь к картинке',
        ]);

        CategoryMenu::create([
            'category_name' => 'Закуски',
            'img_src' => 'путь к картинке',
        ]);

        CategoryMenu::create([
            'category_name' => 'Салаты',
            'img_src' => 'путь к картинке',
        ]);

        CategoryMenu::create([
            'category_name' => 'Десерты',
            'img_src' => 'путь к картинке',
        ]);
    }
}
