<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /********************************************************
         * super admin
         ********************************************************/
        $super_admin_permissions = Permission::all();
        Role::updateOrCreate(['name' => 'Super Admin', 'slug' => 'super-admin', 'deletable' => false])
            ->permissions()
            ->sync($super_admin_permissions->pluck('id'));
        /********************************************************
         *  admin
         ********************************************************/
        $admin_excludes = ['app.roles.index',
                     'app.roles.create',
                     'app.roles.edit',
                     'app.roles.destroy',
                     'app.menus.index',
                     'app.menus.create',
                     'app.menus.edit',
                     'app.menus.destroy',
                     'app.settings.telescope'];
        $admin_permissions = Permission::whereNotIn('slug', $admin_excludes)->get();
        Role::updateOrCreate(['name' => 'Admin', 'slug' => 'admin', 'deletable' => false])
            ->permissions()
            ->sync($admin_permissions->pluck('id'));

        /********************************************************
         * author
         ********************************************************/
        $author_excludes = ['app.roles.index',
                            'app.roles.create',
                            'app.roles.edit',
                            'app.roles.destroy',
                            'app.menus.index',
                            'app.menus.create',
                            'app.menus.edit',
                            'app.menus.destroy',
                            'app.settings.telescope',
                            'app.users.index',
                            'app.users.create',
                            'app.users.destroy'];

        $author_permissions = Permission::whereNotIn('slug', $author_excludes)->get();
        Role::updateOrCreate(['name' => 'Author', 'slug' => 'author', 'deletable' => true])
            ->permissions()
            ->sync($author_permissions->pluck('id'));
        
    }
}
