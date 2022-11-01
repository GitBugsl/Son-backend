<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Seller']);
        $role1 = Role::create(['name' => 'User']);
        $role = Role::create(['name' => 'Carrier']);
        $role = Role::create(['name' => 'Admin']);

        $permission = Permission::create(['name' => 'Userexcept']);
        $permission->assignRole($role1);
    }

    
}
