<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Messages management
        $moduleAppMessage = Module::updateOrCreate(['name' => ['en'=>'Messages Management', 'ar'=>'ادارة الرسائل']]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMessage->id,
            'name' => ['en'=>'Access Messages','ar'=>'الوصول الى الرسائل'],
            'slug' => 'app.messages.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMessage->id,
            'name' => ['en'=>'Create Message','ar'=>'انشاء الرسائل'],
            'slug' => 'app.messages.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMessage->id,
            'name' => ['en'=>'Edit Message','ar'=>'تعديل الرسائل'],
            'slug' => 'app.messages.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMessage->id,
            'name' => ['en'=>'Delete Message','ar'=>'حذف الرسائل'],
            'slug' => 'app.messages.destroy',
        ]);

        $super_admin_permissions = Permission::all();
        $super_admin_role = Role::where('slug','super-admin')->first();
        $super_admin_role->permissions()->sync($super_admin_permissions->pluck('id'));
    }
}
