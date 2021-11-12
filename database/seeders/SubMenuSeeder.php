<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Models\SubMenu::factory(env('DB_SEEDER', 10))->create();
    }
}
