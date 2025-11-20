<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Test User',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );

        if (Permission::count() === 0) {
            $this->call(\Database\Seeders\PermissionSeeder::class);
        }

        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $employeeRole = Role::firstOrCreate(['name' => 'Employee']);
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);

        $allPermissions = Permission::all();

        $adminRole->syncPermissions($allPermissions);
        $managerPermissions = $allPermissions->reject(function ($permission) {
            return str_starts_with($permission->name, 'users.');
        });
        $managerRole->syncPermissions($managerPermissions);
        $employeePermissions = $allPermissions->filter(function ($permission) {
            return str_ends_with($permission->name, '.view') && !str_starts_with($permission->name, 'users.');
        });
        $employeeRole->syncPermissions($employeePermissions);

        $user->assignRole($adminRole);
    }
}
