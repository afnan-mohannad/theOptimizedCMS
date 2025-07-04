<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SubscriberSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //website settings
        $this->call(SettingSeeder::class);
        //users-roles-permissions
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        //custom
        $this->call(BannerSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(SubscriberSeeder::class);
        $this->call(MessageSeeder::class);
        //menu 
        $this->call(MenuSeeder::class);

        //Posts dummy data
        //$this->call(DummyDataSeeder::class);
    }
}
