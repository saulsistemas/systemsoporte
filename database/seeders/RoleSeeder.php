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
        $role1=Role::create(['name'=>'SUPERADMIN']);
        $role2=Role::create(['name'=>'ADMIN']);
        $role3=Role::create(['name'=>'SOPORTE']);
        $role4=Role::create(['name'=>'CLIENTE']);

        Permission::create(['name'=>'admin.home','description'=>'Ver el Dashboard'])->syncRoles([$role1,$role2,$role3,$role4]);

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

        Permission::create(['name'=>'admin.levels.index','description'=>'Ver listado de level'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.levels.create','description'=>'Crear level'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.levels.edit','description'=>'Editar level'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.levels.destroy','description'=>'Eliminar level'])->syncRoles([$role1]);

        Permission::create(['name'=>'admin.areas.index','description'=>'Ver listado de ??rea'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.areas.create','description'=>'Crear ??rea'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.areas.edit','description'=>'Editar ??rea'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.areas.destroy','description'=>'Eliminar ??rea'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.areas.restore','description'=>'Restaurar ??rea'])->syncRoles([$role1]);

        Permission::create(['name'=>'admin.tickets.index','description'=>'Ver listado de ticket'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'admin.tickets.show','description'=>'Detalle de ticket'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'admin.tickets.create','description'=>'Crear ticket'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'admin.tickets.edit','description'=>'Editar ticket'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'admin.tickets.destroy','description'=>'Eliminar ticket'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'admin.tickets.restore','description'=>'Restaurar ticket'])->syncRoles([$role1,$role2,$role3]);

    }
}
