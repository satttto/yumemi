<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            [ 'id' => Level::BEGINNER, 'name' => '初級' ],
            [ 'id' => Level::INTERMEDIATE, 'name' => '中級' ],
            [ 'id' => Level::ADVANCED, 'name' => '上級' ],
        ]);
    }
}
