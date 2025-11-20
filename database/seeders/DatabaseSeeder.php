<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
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
        $userData = [
            [
                'name' => 'Alice Wonder',
                'email' => 'alice.wonder@example.com',
                'password' => 'password123',
                'role' => 'Admin',
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike.johnson@example.com',
                'password' => 'password123',
                'role' => 'Manager',
            ],
            [
                'name' => 'Eve Love',
                'email' => 'eve.love@example.com',
                'password' => 'password123',
                'role' => 'Employee',
            ],
            [
                'name' => 'John Michael',
                'email' => 'john.michael@example.com',
                'password' => 'password123',
                'role' => 'Employee',
            ],
        ];

        if (Permission::count() === 0) {
            $this->call(\Database\Seeders\PermissionSeeder::class);
        }

        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);
        $employeeRole = Role::firstOrCreate(['name' => 'Employee']);

        $allPermissions = Permission::all();

        // Assign permissions
        $adminRole->syncPermissions($allPermissions);

        $managerPermissions = $allPermissions->filter(function ($permission) {
            return str_starts_with($permission->name, 'items.') || $permission->name == 'users.view';
        });
        $managerRole->syncPermissions($managerPermissions);

        $employeePermissions = $allPermissions->filter(function ($permission) {
            return $permission->name === 'items.view';
        });
        $employeeRole->syncPermissions($employeePermissions);

        // Create users and assign roles
        foreach ($userData as $userItem) {
            $user = User::firstOrCreate(
                ['email' => $userItem['email']],
                [
                    'name' => $userItem['name'],
                    'password' => $userItem['password'],
                    'email_verified_at' => now(),
                ]
            );

            $role = match ($userItem['role']) {
                'Admin' => $adminRole,
                'Manager' => $managerRole,
                'Employee' => $employeeRole,
            };

            $user->assignRole($role);
        }

        // Example Pizzeria Products
        $items = [
            // Specials
            ['name' => 'Margherita Pizza', 'description' => 'Classic cheese and tomato', 'category' => Category::SPECIALS, 'price' => 10.99],
            ['name' => 'Pepperoni Feast', 'description' => 'Loaded with pepperoni slices', 'category' => Category::SPECIALS, 'price' => 12.99],
            ['name' => 'BBQ Chicken Special', 'description' => 'Grilled chicken with BBQ sauce', 'category' => Category::SPECIALS, 'price' => 13.49],
            ['name' => 'Mediterranean Delight', 'description' => 'Olives, feta, tomatoes, and basil', 'category' => Category::SPECIALS, 'price' => 12.79],

            // Main Course
            ['name' => 'Four Cheese Pizza', 'description' => 'Mozzarella, cheddar, parmesan, gouda', 'category' => Category::MAIN_COURSE, 'price' => 11.49],
            ['name' => 'Veggie Supreme', 'description' => 'Bell peppers, onions, mushrooms, olives', 'category' => Category::MAIN_COURSE, 'price' => 11.99],
            ['name' => 'Meat Lovers', 'description' => 'Pepperoni, ham, sausage, bacon', 'category' => Category::MAIN_COURSE, 'price' => 13.99],
            ['name' => 'Hawaiian Pizza', 'description' => 'Ham and pineapple', 'category' => Category::MAIN_COURSE, 'price' => 12.49],
            ['name' => 'Spicy Italian', 'description' => 'Spicy salami with hot peppers', 'category' => Category::MAIN_COURSE, 'price' => 13.49],
            ['name' => 'Mushroom Truffle', 'description' => 'Wild mushrooms with truffle oil', 'category' => Category::MAIN_COURSE, 'price' => 14.29],

            // Snacks
            ['name' => 'Garlic Bread', 'description' => 'Toasted garlic bread with herbs', 'category' => Category::SNACKS, 'price' => 4.99],
            ['name' => 'Chicken Wings', 'description' => 'Spicy fried chicken wings', 'category' => Category::SNACKS, 'price' => 6.99],
            ['name' => 'Mozzarella Sticks', 'description' => 'Fried cheese sticks with marinara', 'category' => Category::SNACKS, 'price' => 5.49],
            ['name' => 'Stuffed Jalapenos', 'description' => 'Cheese-filled spicy peppers', 'category' => Category::SNACKS, 'price' => 5.99],
            ['name' => 'Bruschetta', 'description' => 'Tomato, basil, garlic on toasted bread', 'category' => Category::SNACKS, 'price' => 4.79],

            // Desserts
            ['name' => 'Tiramisu', 'description' => 'Classic Italian dessert', 'category' => Category::DESSERTS, 'price' => 5.99],
            ['name' => 'Chocolate Lava Cake', 'description' => 'Molten chocolate cake', 'category' => Category::DESSERTS, 'price' => 6.49],
            ['name' => 'Cannoli', 'description' => 'Crispy pastry with sweet ricotta filling', 'category' => Category::DESSERTS, 'price' => 5.79],

            // Drinks
            ['name' => 'Coca-Cola', 'description' => 'Refreshing soda', 'category' => Category::DRINKS, 'price' => 1.99],
            ['name' => 'Lemonade', 'description' => 'Freshly squeezed', 'category' => Category::DRINKS, 'price' => 2.49],
            ['name' => 'Iced Tea', 'description' => 'Chilled tea with lemon', 'category' => Category::DRINKS, 'price' => 2.29],
        ];

        foreach ($items as $item) {
            Item::factory()->create($item);
        }
    }
}
