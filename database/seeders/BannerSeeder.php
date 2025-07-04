<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Banners management
        $moduleAppBanner = Module::updateOrCreate(['name' => ['en'=>'Banners Management', 'ar'=>'Banners Management']]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBanner->id,
            'name' => ['en'=>'Access Banners','ar'=>'الوصل الى الصور'],
            'slug' => 'app.banners.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBanner->id,
            'name' => ['en'=>'Create Banner','ar'=>'انشاء الصور'],
            'slug' => 'app.banners.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBanner->id,
            'name' => ['en'=>'Edit Banner','ar'=>'تعديل الصور'],
            'slug' => 'app.banners.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBanner->id,
            'name' => ['en'=>'Delete Banner','ar'=>'حذف الصور'],
            'slug' => 'app.banners.destroy',
        ]);

        $super_admin_permissions = Permission::all();
        $super_admin_role = Role::where('slug','super-admin')->first();
        $super_admin_role->permissions()->sync($super_admin_permissions->pluck('id'));
    }
}
