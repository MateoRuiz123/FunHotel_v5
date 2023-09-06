<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin Seeder
        $user = User::create([
            'name' => 'Mateo',
            'surname' => 'Admin',
            'birthday' => '1990-01-01',
            'email' => 'admin@mateo.com',
            'password' => bcrypt('password')
        ],[
            'name' => 'Andrw',
            'surname' => 'Admin',
            'birthday' => '1990-01-01',
            'email' => 'admin@andrw.com',
            'password' => bcrypt('admin1234')
        ]);
        $role = Role::create(['name' => 'Administrador']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
