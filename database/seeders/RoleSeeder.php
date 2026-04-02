<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'superadmin']);

        // ─── Create Roles ───────────────────────────────────────────────
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        // ─── Sync Permissions to Roles ──────────────────────────────────
        $admin->syncPermissions(Permission::all());

        $user->syncPermissions(
            Permission::whereIn('name', [
                'user.viewAny',
                'user.view',
                'role.viewAny',
                'role.view',
            ])->get()
        );
    }
}
