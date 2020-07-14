<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);
        Permission::create(['name' => 'show articles']);


        $role = Role::create(['name' => 'customer'])->givePermissionTo(['show articles']);
        $role = Role::create(['name' => 'kasa'])->givePermissionTo(['publish articles', 'unpublish articles', "edit articles"]);
        $role = Role::create(['name' => 'worker'])->givePermissionTo(Permission::all());
        $role = Role::create(['name' => 'developer'])->givePermissionTo(Permission::all());
        $role = Role::create(['name' => 'owner'])->givePermissionTo(Permission::all());
    }
}
