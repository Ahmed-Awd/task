<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasPermissions;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//        DB::table('permissions')->truncate();
//        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('permissions')->insertOrIgnore([


            ['name' => 'list users','guard_name'=> 'web'],
            ['name' => 'add users','guard_name'=> 'web'],
            ['name' => 'edit users','guard_name'=> 'web'],
            ['name' => 'delete users','guard_name'=> 'web'],

            ['name' => 'list items','guard_name'=> 'web'],
            ['name' => 'add items','guard_name'=> 'web'],
            ['name' => 'edit items','guard_name'=> 'web'],
            ['name' => 'delete items','guard_name'=> 'web'],

            ['name' => 'list storages','guard_name'=> 'web'],
            ['name' => 'add storages','guard_name'=> 'web'],
            ['name' => 'edit storages','guard_name'=> 'web'],
            ['name' => 'delete storages','guard_name'=> 'web'],


        ]);
    }
}
