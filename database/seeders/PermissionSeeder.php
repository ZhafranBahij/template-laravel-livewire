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
        // ─── User Permissions ───────────────────────────────────────────
        Permission::firstOrCreate(['name' => 'user.viewAny']);
        Permission::firstOrCreate(['name' => 'user.view']);
        Permission::firstOrCreate(['name' => 'user.create']);
        Permission::firstOrCreate(['name' => 'user.update']);
        Permission::firstOrCreate(['name' => 'user.delete']);
        Permission::firstOrCreate(['name' => 'user.restore']);
        Permission::firstOrCreate(['name' => 'user.forceDelete']);

        // ─── Role Permissions ───────────────────────────────────────────
        Permission::firstOrCreate(['name' => 'role.viewAny']);
        Permission::firstOrCreate(['name' => 'role.view']);
        Permission::firstOrCreate(['name' => 'role.create']);
        Permission::firstOrCreate(['name' => 'role.update']);
        Permission::firstOrCreate(['name' => 'role.delete']);
        Permission::firstOrCreate(['name' => 'role.restore']);
        Permission::firstOrCreate(['name' => 'role.forceDelete']);
    }
}
