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
        //Reset DB
        DB::unprepared('SET FOREIGN_KEY_CHECKS = 0');
        DB::unprepared('TRUNCATE model_has_permissions');
        DB::unprepared('TRUNCATE model_has_roles');
        DB::unprepared('TRUNCATE role_has_permissions');
        DB::unprepared('TRUNCATE roles; #todo delete m');
        DB::unprepared('TRUNCATE permissions; #todo delete m');

        DB::unprepared('TRUNCATE categories;');
        DB::unprepared('SET FOREIGN_KEY_CHECKS = 1');

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
//        Permission::create(['name' => 'create_buildings']);
//        Permission::create(['name' => 'edit_buildings']);
//        Permission::create(['name' => 'delete_buildings']);

        Permission::create(['name' => 'manage_buildings']);
        Permission::create(['name' => 'work_in_buildings']);

        // create roles and assign existing permissions
        $role = Role::create(['name' => 'manager']);
        $role->givePermissionTo('manage_buildings');

        $role = Role::create(['name' => 'employee']);
        $role->givePermissionTo('work_in_buildings');

        $user = \App\User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456'),
        ]);
        $user->assignRole('manager');

        $user = \App\User::create([
            'name' => 'Employee',
            'email' => 'employee@example.com',
            'password' => bcrypt('123456'),
        ]);
        $user->assignRole('employee');

        \App\User::create([
            'name' => 'Normal User',
            'email' => 'normal@example.com',
            'password' => bcrypt('123456'),
        ]);

//        $role->givePermissionTo('create_buildings');
//        $role->givePermissionTo('edit_buildings');
//        $role->givePermissionTo('delete_buildings');

//        $role = Role::create(['name' => 'admin']);
//        $role->givePermissionTo('publish articles');
//        $role->givePermissionTo('unpublish articles');
    }
}
