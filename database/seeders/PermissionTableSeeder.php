<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'reservation-list',
            'reservation-create',
            'reservation-edit',
            'reservation-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'table-list',
            'table-create',
            'table-edit',
            'table-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}