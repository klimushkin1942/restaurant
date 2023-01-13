<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Artemiy',
            'login' => '1942',
            'password' => bcrypt('admin'),
            'pinCode' => '13790',
            'isAdmin' => true,
        ]);
    }
}
