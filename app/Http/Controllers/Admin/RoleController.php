<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RoleController extends Controller
{
    public function __construct()
    {
        #ESTO FUNCIONA PARA EL CONTROLADOR - SE TIENE QUE PONER CASO CONTRARIO ACCEDEN POR LA RUTA
        $this->middleware('can:roles.index')->only('index');
        $this->middleware('can:roles.create')->only('create','store');
        $this->middleware('can:roles.edit')->only('edit','update');
        $this->middleware('can:roles.destroy')->only('destroy');
    }
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
        #return redirect()->route('roles.edit',$role)->with(['estado'=>'success','titulo'=>'Guardado!','texto'=>'Se guardó correctamente']);
        return redirect()->route('roles.index')->with(['estado'=>'success','titulo'=>'Guardado!','texto'=>'Se guardó correctamente']);
        
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
        return redirect()->route('roles.index')->with(['estado'=>'warning','titulo'=>'Modificado!','texto'=>'Se modificó correctamente']);
        #return redirect()->route('roles.edit',$role)->with(['estado'=>'warning','titulo'=>'Modificado!','texto'=>'Se modificó correctamente']);
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with(['estado'=>'danger','titulo'=>'Eliminado!','texto'=>'Se eliminó correctamente']);
    }
}
