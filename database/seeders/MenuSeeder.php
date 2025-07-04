<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::updateOrCreate(['name' => 'backend-sidebar', 'description' => 'This is backend sidebar', 'deletable' => false]);

        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'divider', 'parent_id' => null, 'order' => 1, 'divider_title' => ['ar'=>'الرئيسية', 'en'=>'Main'], 'permission_id'=>null]);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 2, 'title' => ['ar'=>'لوحة التحكم', 'en'=>'Dashboard'], 'url' => "/app/dashboard", 'icon_class' => 'bi bi-speedometer2', 'permission_id'=>1]);

        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'divider', 'parent_id' => null, 'order' => 3, 'divider_title' => ['ar'=>'المحتوى', 'en'=>'Content'], 'permission_id'=>null]);
        
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 4, 'title' => ['ar'=>'الصفحات', 'en'=>'Pages'], 'url' => "/app/pages", 'icon_class' => 'bi bi-newspaper', 'permission_id'=>15]);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 5, 'title' => ['ar'=>'صور الصفحة الرئيسية', 'en'=>'Banners'], 'url' => "/app/banners", 'icon_class' => 'bi bi bi-images', 'permission_id'=>31]);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 6, 'title' => ['ar'=>'الفئات', 'en'=>'Categories'], 'url' => "/app/categories", 'icon_class' => 'bi bi-bookmark-star', 'permission_id'=>23]);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 7, 'title' => ['ar'=>'الوسوم', 'en'=>'Tags'], 'url' => "/app/tags", 'icon_class' => 'bi bi-tags', 'permission_id'=>31]);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 8, 'title' => ['ar'=>'المنشورات', 'en'=>'Posts'], 'url' => "/app/posts", 'icon_class' => 'bi bi-pencil-square', 'permission_id'=>27]);
        
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'divider', 'parent_id' => null, 'order' => 9, 'divider_title' => ['ar'=>'التواصل', 'en'=>'Communication'], 'permission_id'=>null]);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 10, 'title' => ['ar'=>'المشتركين', 'en'=>'Subscribers'], 'url' => "/app/subscribers", 'icon_class' => 'bi bi-send-check-fill', 'permission_id'=>39]);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 11, 'title' => ['ar'=>'الرسائل', 'en'=>'Messages'], 'url' => "/app/messages", 'icon_class' => 'bi bi-chat-left-text-fill', 'permission_id'=>43]);


        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'divider', 'parent_id' => null, 'order' => 12, 'divider_title' => ['ar'=>'امكانية الوصول', 'en'=>'Access Control'], 'permission_id'=>null]);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 13, 'title' => ['ar'=>'المستخدمين', 'en'=>'Users'], 'url' => "/app/users", 'icon_class' => 'bi bi-people-fill', 'permission_id'=>11]);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item','parent_id' => null, 'order' => 14, 'title' => ['ar'=>'الأدوار', 'en'=>'Roles'], 'url' => "/app/roles", 'icon_class' => 'bi bi-check-circle-fill', 'permission_id'=>7]);

        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'divider', 'parent_id' => null, 'order' => 15, 'divider_title' => ['ar'=>'النظام', 'en'=>'System'], 'permission_id'=>null]);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 16, 'title' => ['ar'=>'الاعدادات', 'en'=>'Settings'], 'url' => "/app/settings/general", 'icon_class' => 'bi bi-gear', 'permission_id'=>2]);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 17, 'title' => ['ar'=>'القوائم', 'en'=>'Menus'], 'url' => "/app/menus", 'icon_class' => 'bi bi-menu-button-wide-fill', 'permission_id'=>19]);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 18, 'title' => ['ar'=>'Telescope', 'en'=>'Telescope'], 'url' => "/telescope", 'icon_class' => 'bi bi-display-fill', 'permission_id'=>4, 'target'=>'_blank']);
    }
}