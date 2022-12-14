<?php

namespace Database\Seeders;

use App\Models\Timbrage;
use Illuminate\Database\Seeder;

class TimbrageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Timbrage::factory()->count(50)->create();
    }
}
