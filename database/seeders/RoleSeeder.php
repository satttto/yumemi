<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [ 'id' => Role::ADMIN, 'type' => '管理者' ], 
            [ 'id' => Role::STANDARD, 'type' => '一般' ],
        ]);
    }
}
