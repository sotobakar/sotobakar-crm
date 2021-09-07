<?php

namespace Database\Seeders;

use App\Models\User;
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

        // create clients permissions
        Permission::create(['name' => 'create clients']);
        Permission::create(['name' => 'view clients']);
        Permission::create(['name' => 'edit clients']);
        Permission::create(['name' => 'delete clients']);
        // create projects permissions
        Permission::create(['name' => 'create projects']);
        Permission::create(['name' => 'view projects']);
        Permission::create(['name' => 'edit projects']);
        Permission::create(['name' => 'delete projects']);
        // create tasks permissions
        Permission::create(['name' => 'create tasks']);
        Permission::create(['name' => 'view tasks']);
        Permission::create(['name' => 'edit tasks']);
        Permission::create(['name' => 'delete tasks']);
        // create opportunities permissions
        Permission::create(['name' => 'create opportunities']);
        Permission::create(['name' => 'view opportunities']);
        Permission::create(['name' => 'edit opportunities']);
        Permission::create(['name' => 'delete opportunities']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $employee = Role::create(['name' => 'employee']);
        $employee->givePermissionTo('view clients');
        $employee->givePermissionTo('view projects');
        $employee->givePermissionTo('view tasks');
        $employee->givePermissionTo('view opportunities');

        // or may be done by chaining
        Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());

        User::where('email', '=', 'pet.santino@gmail.com')->first()->assignRole('admin');
        User::where('email', '=', 'gabrielkheisa@gmail.com')->first()->assignRole('employee');
    }
}
