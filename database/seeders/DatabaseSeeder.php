<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vote;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(TaskSeeder::class);

        // TODO: もっと良い書き方を
        Vote::create([
            'user_id' => 2,
            'answer' => 1,
        ]);
    }
}
