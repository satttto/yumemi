<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;

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

        // Insert user's achievement samples
        // Note: This might cause an error
        // TODO: Use another way to create more data.
        Achievement::factory(3)->create();

    }
}
