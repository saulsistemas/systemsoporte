<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1=Role::create(['name'=>'Admin']);
        $role2=Role::create(['name'=>'Soporte']);
        $role3=Role::create(['name'=>'Cliente']);

        Permission::create(['name'=>'home','description'=>'Ver el Dashboard'])->syncRoles([$role1,$role2,$role3]);

        Permission::create(['name'=>'users.index','description'=>'Ver listado de usuarios'])->syncRoles([$role1]);
        Permission::create(['name'=>'users.create','description'=>'Crear usuario'])->syncRoles([$role1]);
        Permission::create(['name'=>'users.edit','description'=>'Editar usuario'])->syncRoles([$role1]);
        Permission::create(['name'=>'users.destroy','description'=>'Eliminar usuario'])->syncRoles([$role1]);
        Permission::create(['name'=>'users.restore','description'=>'Restaurar usuario'])->syncRoles([$role1]);

        Permission::create(['name'=>'roles.index','description'=>'Ver listado de roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'roles.create','description'=>'Crear roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'roles.edit','description'=>'Editar roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'roles.destroy','description'=>'Eliminar roles'])->syncRoles([$role1]);
    }
}
