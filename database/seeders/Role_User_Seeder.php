<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Role_User_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles_user')->insert([
            'role_id' => 1,
            'user_id' => 1
        ]);

        DB::table('roles_user')->insert([
            'role_id' => 1,
            'user_id' => 2
        ]);
    }
}
