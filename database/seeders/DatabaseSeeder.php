<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            
        ]);

        $role1 = Role::create(['name' => 'moderator']);
        $role2 = Role::create(['name' => 'guest']);

        $permission1 = Permission::create(['name' => 'create stock']);
        $permission2 = Permission::create(['name' => 'edit stock']);
        $permission3 = Permission::create(['name' => 'view stock']);
        $permission4 = Permission::create(['name' => 'delete stock']);

        $role1->syncPermissions([$permission1, $permission2, $permission3, $permission4]);
        $role2->syncPermissions([$permission3]);
    }
}
