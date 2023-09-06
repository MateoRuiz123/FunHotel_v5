<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //Permissions
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'servicio-list',
            'servicio-create',
            'servicio-edit',
            'servicio-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'cliente-list',
            'cliente-create',
            'cliente-edit',
            'cliente-delete',
            'group-list',
            'group-create',
            'group-edit',
            'group-delete',
            'checkin-list',
            'checkin-create',
            'checkin-edit',
            'checkin-delete',
            'categoria-list',
            'categoria-create',
            'categoria-edit',
            'categoria-delete',
            'reserva-list',
            'reserva-create',
            'reserva-edit',
            'reserva-delete',
            'habitacion-list',
            'habitacion-create',
            'habitacion-edit',
            'habitacion-delete',
            'venta-list',
            'venta-create',
            'venta-edit',
            'venta-delete',
            'checkout-list',
            'checkout-create',
            'checkout-edit',
            'checkout-delete',
            'pago-list',
            'pago-create',
            'pago-edit',
            'pago-delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
