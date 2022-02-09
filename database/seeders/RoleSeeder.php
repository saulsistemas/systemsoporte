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

        Permission::create(['name'=>'admin.home','description'=>'Ver el Dashboard'])->syncRoles([$role1,$role2,$role3]);

        Permission::create(['name'=>'admin.users.index','description'=>'Ver listado de usuarios'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.users.create','description'=>'Crear usuario'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.users.edit','description'=>'Editar usuario'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.users.destroy','description'=>'Eliminar usuario'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.users.restore','description'=>'Restaurar usuario'])->syncRoles([$role1]);

        Permission::create(['name'=>'admin.roles.index','description'=>'Ver listado de roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.create','description'=>'Crear roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.edit','description'=>'Editar roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.destroy','description'=>'Eliminar roles'])->syncRoles([$role1]);
    
        Permission::create(['name'=>'admin.projects.index','description'=>'Ver listado de proyecto'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.projects.create','description'=>'Crear proyecto'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.projects.edit','description'=>'Editar proyecto'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.projects.destroy','description'=>'Eliminar proyecto'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.projects.restore','description'=>'Restaurar proyecto'])->syncRoles([$role1]);

    }
}
