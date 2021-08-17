<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Satoshi',
                'email' => 'satoshi@example.com',
                'password' => bcrypt('12345678'),
                'role_id' => Role::STANDARD,
            ],
            [
                'name' => 'Yumemi',
                'email' => 'yumemi@example.com',
                'password' => bcrypt('12345678'),
                'role_id' => Role::STANDARD,
            ],
        ]);
    }
}