<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dashboard
        $moduleAppDashboard = Module::updateOrCreate(['name' => ['en'=>'Admin Dashboard', 'ar'=>'لوحة تحكم المشرف']]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppDashboard->id,
            'name' => ['en'=>'Access Dashboard','ar'=>'ادارة لوحة التحكم'],
            'slug' => 'app.dashboard',
        ]);

        // Settings
        $moduleAppSettings = Module::updateOrCreate(['name' => ['en'=>'Settings','ar'=>'إعدادات']]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSettings->id,
            'name' => ['en'=>'Access Settings','ar'=>'ادارة الاعدادت'] ,
            'slug' => 'app.settings.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSettings->id,
            'name' => ['en'=>'Update Settings','ar'=>'تحديث الاعدادات'],
            'slug' => 'app.settings.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSettings->id,
            'name' => ['en'=>'Telescope','ar'=>'تلسكوب'],
            'slug' => 'app.settings.telescope',
        ]);

        // Profile
        $moduleAppProfile = Module::updateOrCreate(['name' => ['en'=>'Profile','ar'=>'الملف الشخصي']]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProfile->id,
            'name' => ['en'=>'Update Profile','ar'=>'تحديث الملف الشخصي'],
            'slug' => 'app.profile.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProfile->id,
            'name' => ['en'=>'Update Password','ar'=>'تحديث كلمة المرور'],
            'slug' => 'app.profile.password',
        ]);

        // Role management
        $moduleAppRole = Module::updateOrCreate(['name' => ['en'=>'Role Management','ar'=>'إدارة الأدوار']]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => ['en'=>'Access Roles','ar'=>'ادارة الأدوار'],
            'slug' => 'app.roles.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => ['en'=>'Create Role','ar'=>'انشاء دور'],
            'slug' => 'app.roles.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => ['en'=>'Edit Role','ar'=>'تحديث دور'],
            'slug' => 'app.roles.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => ['en'=>'Delete Role','ar'=>'حذف دور'],
            'slug' => 'app.roles.destroy',
        ]);

        // User management
        $moduleAppUser = Module::updateOrCreate(['name' => ['en'=>'User Management','ar'=>'ادارة المستخدمين']]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => ['en'=>'Access Users','ar'=>'ادارة المستخدمين'],
            'slug' => 'app.users.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => ['en'=>'Create User','ar'=>'انشاء مستخدم'],
            'slug' => 'app.users.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => ['en'=>'Edit User','ar'=>'تحديث مستخدم'],
            'slug' => 'app.users.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => ['en'=>'Delete User','ar'=>'حذف مستخدم'],
            'slug' => 'app.users.destroy',
        ]);

        // Page management
        $moduleAppPage = Module::updateOrCreate(['name' => ['en'=>'Page Management','ar'=>'ادارة الصفحات']]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => ['en'=>'Access Pages','ar'=>'ادارة الصفحات'],
            'slug' => 'app.pages.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => ['en'=>'Create Page','ar'=>'انشاء صفحة'],
            'slug' => 'app.pages.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => ['en'=>'Edit Page','ar'=>'تحديث صفحة'],
            'slug' => 'app.pages.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => ['en'=>'Delete Page','ar'=>'حذف صفحة'],
            'slug' => 'app.pages.destroy',
        ]);

        // Menu management
        $moduleAppMenu = Module::updateOrCreate(['name' => ['en'=>'Menu Management','ar'=>'ادارة القوائم']]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => ['en'=>'Access Menus','ar'=>'ادارة القوائم'],
            'slug' => 'app.menus.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => ['en'=>'Create Menu','ar'=>'انشاء قائمة'],
            'slug' => 'app.menus.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => ['en'=>'Edit Menu','ar'=>'تحديث قائمة'],
            'slug' => 'app.menus.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => ['en'=>'Delete Menu','ar'=>'حذف قائمة'],
            'slug' => 'app.menus.destroy',
        ]);

        // Categories management
        $moduleAppCategory = Module::updateOrCreate(['name' => ['en'=>'Category Management', 'ar'=>'ادارة الفئات']]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCategory->id,
            'name' => ['en'=>'Access Categories','ar'=>'ادارة الفئات'],
            'slug' => 'app.categories.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCategory->id,
            'name' => ['en'=>'Create Category','ar'=>'انشاء فئة'],
            'slug' => 'app.categories.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCategory->id,
            'name' => ['en'=>'Edit Category','ar'=>'تحديث فئة'],
            'slug' => 'app.categories.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCategory->id,
            'name' => ['en'=>'Delete Category','ar'=>'حذف فئة'],
            'slug' => 'app.categories.destroy',
        ]);

        // Post management
        $moduleAppPost = Module::updateOrCreate(['name' => ['en'=>'Post Management','ar'=>'ادارة الأخبار']]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPost->id,
            'name' => ['en'=>'Access Posts','ar'=>'ادارة الأخبار'],
            'slug' => 'app.posts.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPost->id,
            'name' => ['en'=>'Create Post','ar'=>'انشاء خبر'],
            'slug' => 'app.posts.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPost->id,
            'name' => ['en'=>'Edit Post','ar'=>'تحديث خبر'],
            'slug' => 'app.posts.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPost->id,
            'name' => ['en'=>'Delete Post','ar'=>'حذف خبر'],
            'slug' => 'app.posts.destroy',
        ]);
        
    }
}
