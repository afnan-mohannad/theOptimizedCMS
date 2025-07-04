<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tags management
        $moduleAppTag = Module::updateOrCreate(['name' => ['en'=>'Tags Management', 'ar'=>'ادارة الوسوم']]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTag->id,
            'name' => ['en'=>'Access Tags','ar'=>'الوصول الى الوسوم'],
            'slug' => 'app.tags.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTag->id,
            'name' => ['en'=>'Create Tag','ar'=>'انشاء الوسوم'],
            'slug' => 'app.tags.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTag->id,
            'name' => ['en'=>'Edit Tag','ar'=>'تعديل الوسوم'],
            'slug' => 'app.tags.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTag->id,
            'name' => ['en'=>'Delete Tag','ar'=>'حذف الوسوم'],
            'slug' => 'app.tags.destroy',
        ]);

        $super_admin_permissions = Permission::all();
        $super_admin_role = Role::where('slug','super-admin')->first();
        $super_admin_role->permissions()->sync($super_admin_permissions->pluck('id'));
    }
}