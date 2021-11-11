<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QrCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\QrCode::factory(env('DB_SEEDER', 10))->create();
    }
}
