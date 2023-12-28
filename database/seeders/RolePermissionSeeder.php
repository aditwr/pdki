<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // reset cached roles and permissions
        app()[Permission::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'akses-admin']);
        Permission::create(['name' => 'akses-pemohon']);

        // create roles and assign created permissions
        $admin = \Spatie\Permission\Models\Role::create(['name' => 'admin']);
        $admin->givePermissionTo('akses-admin');

        $pemohon = \Spatie\Permission\Models\Role::create(['name' => 'pemohon']);
        $pemohon->givePermissionTo('akses-pemohon');
    }
}
