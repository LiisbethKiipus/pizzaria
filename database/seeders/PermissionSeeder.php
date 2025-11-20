<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            "users.view",
            "users.edit",
            "users.delete",
            "users.create",
            "roles.view",
            "roles.edit",
            "roles.delete",
            "roles.create",
            "items.view",
            "items.edit",
            "items.delete",
            "items.create",
        ];
        foreach ($permission as $key => $value) {
            Permission::create(["name" => $value]);
        }
    }
}
