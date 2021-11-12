<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(env('DB_SEEDER', 10))->create();
         \App\Models\Restaurant::factory(env('DB_SEEDER', 10))->create();
         \App\Models\Order::factory(env('DB_SEEDER', 10))->create();
         \App\Models\QrCode::factory(env('DB_SEEDER', 10))->create();
         \App\Models\Menu::factory(env('DB_SEEDER', 10))->create();
         \App\Models\Table::factory(env('DB_SEEDER', 10))->create();
         \App\Models\MenuItem::factory(env('DB_SEEDER', 10))->create();
         \App\Models\SubMenu::factory(env('DB_SEEDER', 10))->create();
         \App\Models\Payment::factory(env('DB_SEEDER', 10))->create();
    }
}
