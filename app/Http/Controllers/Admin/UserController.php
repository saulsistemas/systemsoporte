<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Company;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        #ESTO FUNCIONA PARA EL CONTROLADOR - SE TIENE QUE PONER CASO CONTRARIO ACCEDEN POR LA RUTA
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.create')->only('create','store');
        $this->middleware('can:admin.users.edit')->only('edit','update');
        $this->middleware('can:admin.users.destroy')->only('destroy');
        $this->middleware('can:admin.users.restore')->only('restore');
    }
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $users=User::where("id",">",1)
        ->where('name','LIKE','%'.$busqueda.'%')
        #->Where('email','LIKE','%'.$busqueda.'%')
        ->withTrashed() #se visualizan los eliminados
        ->latest('id')
        ->paginate(10);
        return view('admin.users.index',compact('users','busqueda'));
    }

    public function create()
    {
        $roles = Role::where('id','>',1)->pluck('name','id');
        $companies = Company::where('active','>',0)->pluck('name','id');
        #$companies = Company::all();
        return view('admin.users.create',compact('roles','companies'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'code'=>'required|unique:users',
            'name'=>'required',
            'office_id'=>'required',
            'area_id'=>'required',
            'password'=>'required',
            'email'=>'required|email|unique:users',
        ]);
        
        $user = User::create([
            'code'=>$request->code,
            'name'=>$request->name,
            'position'=>$request->position,
            'last_name'=>$request->last_name,
            'phone'=>$request->phone,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
            'office_id'=>$request->office_id,
            'role_id'=>$request->role_id,
            'area_id'=>$request->area_id,
            'company_id'=>$request->company_id,
        ]);
        $user->roles()->sync($request->role_id);
        return redirect()->route('admin.users.index')->with(['estado'=>'success','titulo'=>'Guardado!','texto'=>'Se guardó correctamente']);
    }
    
    public function show(User $user)
    {
        //
    }
    
    public function edit(User $user)
    {
        $roles = Role::where('id','>',1)->pluck('name','id');
        $companies = Company::where('active','>',0)->pluck('name','id');
        $status = [1=>'Activo',2=>'Desactivo'];
        return view('admin.users.edit',compact('user','roles','companies','status'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'code'=>'required|unique:users,code,'.$user->id,
            'name'=>'required',
            'area_id'=>'required',
            'office_id'=>'required',
            'role_id'=>'required',
        ]);
        $user->code = $request->code;
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->last_name = $request->last_name;
        $user->company_id = $request->company_id;
        $user->office_id = $request->office_id;
        $user->area_id = $request->area_id;
        $user->phone = $request->phone;
        $user->position = $request->position;
        $user->status = $request->status;
        $password = $request->password;
        if ($password) {
            $user->password =bcrypt($password);
        }
        $user->save();
        $user->roles()->sync($request->role_id);
        return redirect()->route('admin.users.index')->with(['estado'=>'warning','titulo'=>'Modificado!','texto'=>'Se modificó correctamente']);
    }
    
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with(['estado'=>'danger','titulo'=>'Eliminado!','texto'=>'Se eliminó correctamente']);
    }
    public function restore($id)
    {
        User::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.users.index')->with(['estado'=>'success','titulo'=>'Restaurado!','texto'=>'Se restauró correctamente']);
    }

    public function officesAll($id){
        return Office::where('company_id',$id)->get();
    }

    public function areasAll($id){
        return Area::where('company_id',$id)->get();
    }
}
