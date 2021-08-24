<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Insert role samples 
        $admin = Role::create(['type' => '権限者']);
        $standard = Role::create(['type' => '一般']);

        
        // Insert user samples
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
            'role_id' => $admin->id,
        ]);
        User::create([
            'name' => 'Satoshi',
            'email' => 'satoshi@example.com',
            'password' => bcrypt('12345678'),
            'role_id' => $standard->id,
        ]);
        User::create([
            'name' => 'Yumemi',
            'email' => 'yumemi@example.com',
            'password' => bcrypt('12345678'),
            'role_id' => $standard->id,
        ]);
    }
}