<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $users=User::where('name','LIKE','%'.$busqueda.'%')
        ->orWhere('email','LIKE','%'.$busqueda.'%')
        ->withTrashed() #se visualizan los eliminados
        ->latest('id')
        ->paginate(10);
        return view('admin.users.index',compact('users','busqueda'));
    }

    public function create()
    {
        $roles = Role::where('id','>',1)->pluck('name','id');
        return view('admin.users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'password'=>'required',
            'email'=>'required|email|unique:users',
        ]);
        $user = User::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
            'role_id'=>$request->role_id,
        ]);
        $user->roles()->sync($request->role_id);
        return redirect()->route('users.index')->with(['estado'=>'success','titulo'=>'Guardado!','texto'=>'Se guardó correctamente']);
    }
    
    public function show(User $user)
    {
        //
    }
    
    public function edit(User $user)
    {
        $roles = Role::where('id','>',1)->pluck('name','id');
        return view('admin.users.edit',compact('user','roles'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required',
            'role_id'=>'required',
        ]);
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $password = $request->password;
        if ($password) {
            $user->password =bcrypt($password);
        }
        $user->save();
        $user->roles()->sync($request->role_id);
        return redirect()->route('users.index')->with(['estado'=>'warning','titulo'=>'Modificado!','texto'=>'Se modificó correctamente']);
    }
    
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with(['estado'=>'danger','titulo'=>'Eliminado!','texto'=>'Se eliminó correctamente']);
    }
    public function restore($id)
    {
        User::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('users.index')->with(['estado'=>'success','titulo'=>'Restaurado!','texto'=>'Se restauró correctamente']);
    }
}
