<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RoleController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $roles=Role::where('name','LIKE','%'.$busqueda.'%')
        ->latest('id')
        ->paginate(10);
        return view('admin.roles.index',compact('roles','busqueda'));
    }

    
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create',compact('permissions'));
    }

  
    public function store(Request $request)
    {
       
        $request->validate([
            'name'=>'required'
        ]);
        
        $role = Role::create(['name' => $request->name]);
        $role->permissions()->sync($request->permissions);
        return redirect()->route('roles.edit',$role)->with('info','Se creo Rol correctament');
        
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit',compact('role','permissions'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $role->update($request->all());
        $role->permissions()->sync($request->permissions);
        return redirect()->route('roles.edit',$role)->with('info','Se editó Rol correctamente');
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('info','Se elimino Rol correctamente');
    }
}
