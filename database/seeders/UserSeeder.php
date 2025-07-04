<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create super admin
        $superAdminRole = Role::where('slug','super-admin')->first();
        User::updateOrCreate([
            'role_id' => $superAdminRole->id,
            'name' => 'Super Admin',
            'bio'=> "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('NAD!@#123'),
            'status' => true
        ]);

        // Create admin
        $adminRole = Role::where('slug','admin')->first();
        User::updateOrCreate([
            'role_id' => $adminRole->id,
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('NAD!@#123'),
            'status' => true
        ]);

        // Create author 1
        $authorRole = Role::where('slug','author')->first();
        User::updateOrCreate([
            'role_id' => $authorRole->id,
            'name' => 'Author 1',
            'bio'=> "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'email' => 'author1@admin.com',
            'password' => Hash::make('NAD!@#123'),
            'status' => true
        ]);

        // Create author 2
        $authorRole = Role::where('slug','author')->first();
        User::updateOrCreate([
            'role_id' => $authorRole->id,
            'name' => 'Author 2',
            'bio'=> "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'email' => 'author2@admin.com',
            'password' => Hash::make('NAD!@#123'),
            'status' => true
        ]);

        // Create author 3
        $authorRole = Role::where('slug','author')->first();
        User::updateOrCreate([
            'role_id' => $authorRole->id,
            'name' => 'Author 3',
            'bio'=> "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'email' => 'author3@admin.com',
            'password' => Hash::make('NAD!@#123'),
            'status' => true
        ]);
        
    }
}
