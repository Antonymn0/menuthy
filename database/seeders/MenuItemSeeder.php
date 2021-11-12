<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Models\MenuItem::factory(env('DB_SEEDER', 10))->create();
    }
}
