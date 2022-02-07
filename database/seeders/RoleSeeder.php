<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::findOrCreate('admin', 'web');


        $role1->givePermissionTo('list users');
        $role1->givePermissionTo('edit users');
        $role1->givePermissionTo('delete users');
        $role1->givePermissionTo('add users');

        $role1->givePermissionTo('list items');
        $role1->givePermissionTo('edit items');
        $role1->givePermissionTo('delete items');
        $role1->givePermissionTo('add items');

        $role1->givePermissionTo('list storages');
        $role1->givePermissionTo('edit storages');
        $role1->givePermissionTo('delete storages');
        $role1->givePermissionTo('add storages');


        $role2 = Role::findOrCreate('guest', 'web');

        $role2->givePermissionTo('add items');


    }
}
