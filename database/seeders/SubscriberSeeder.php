<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubscriberSeeder extends Seeder
{
  /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Subscribers management
        $moduleAppSubscriber = Module::updateOrCreate(['name' => ['en'=>'Subscribers Management', 'ar'=>'ادارة المشتركين']]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSubscriber->id,
            'name' => ['en'=>'Access Subscribers','ar'=>'الوصول الى المشتركين'],
            'slug' => 'app.subscribers.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSubscriber->id,
            'name' => ['en'=>'Create Subscriber','ar'=>'انشاء المشتركين'],
            'slug' => 'app.subscribers.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSubscriber->id,
            'name' => ['en'=>'Edit Subscriber','ar'=>'تعديل المشتركين'],
            'slug' => 'app.subscribers.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSubscriber->id,
            'name' => ['en'=>'Delete Subscriber','ar'=>'حذف المشتركين'],
            'slug' => 'app.subscribers.destroy',
        ]);

        $super_admin_permissions = Permission::all();
        $super_admin_role = Role::where('slug','super-admin')->first();
        $super_admin_role->permissions()->sync($super_admin_permissions->pluck('id'));
    }
}
