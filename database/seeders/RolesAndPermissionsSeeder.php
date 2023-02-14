<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        Permission::create(['name' => 'view post']);
        Permission::create(['name' => 'publish post']);
        Permission::create(['name' => 'un_publish post']);
        Permission::create(['name' => 'edit post']);
        Permission::create(['name' => 'delete post']);
        Permission::create(['name' => 'active post']);
        Permission::create(['name' => 'create post']);

        // create roles and assign created permissions

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('view post');
        $admin->givePermissionTo('publish post');
        $admin->givePermissionTo('un_publish post');
        $admin->givePermissionTo('edit post');
        $admin->givePermissionTo('active post');
        $admin->givePermissionTo('create post');

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo('view post');

        $super_admin = Role::create(['name' => 'super_admin']);
        $super_admin->givePermissionTo(Permission::all());

        //
        $admin = User::where('name', 'admin')->first();
        $user = User::where('name', 'user')->first();
        $super_admin = User::where('name', 'super_admin')->first();

        $admin->assignRole('admin');
        $user->assignRole('user');
        $super_admin->assignRole('super_admin');
    }
}
