<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Company;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function __construct()
    {
        #ESTO FUNCIONA PARA EL CONTROLADOR - SE TIENE QUE PONER CASO CONTRARIO ACCEDEN POR LA RUTA
        $this->middleware('can:admin.areas.index')->only('index');
        $this->middleware('can:admin.areas.create')->only('create','store');
        $this->middleware('can:admin.areas.edit')->only('edit','update');
        $this->middleware('can:admin.areas.destroy')->only('destroy');
        $this->middleware('can:admin.areas.restore')->only('restore');
    }
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $areas=Area::where('name','LIKE','%'.$busqueda.'%')
        ->withTrashed() #se visualizan los eliminados
        ->latest('id')
        ->paginate(10);
        return view('admin.areas.index',compact('areas','busqueda'));
    }

    
    public function create()
    {
        $companies = Company::where('active','=',1)->pluck('name','id');
        return view('admin.areas.create',compact('companies'));
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $area = new Area();
        $area->company_id  =$request->company_id;
        $area->name  =$request->name;
        $area->save();
        return redirect()->route('admin.areas.index')->with(['estado'=>'success','titulo'=>'Guardado!','texto'=>'Se guardó correctamente']);
    }

   
    public function show(Area $area)
    {
        //
    }

    
    public function edit(Area $area)
    {
        $companies = Company::where('active','=',1)->pluck('name','id');
        return view('admin.areas.edit',compact('area','companies'));
    }

    
    public function update(Request $request, Area $area)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $area->update($request->all());
        return redirect()->route('admin.areas.index')->with(['estado'=>'warning','titulo'=>'Modificado!','texto'=>'Se modificó correctamente']);
    }

    
    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('admin.areas.index')->with(['danger'=>'success','titulo'=>'Eliminado!','texto'=>'Se eliminó correctamente']);
    }

    public function restore($id)
    {
        Area::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.areas.index')->with(['estado'=>'success','titulo'=>'Restaurado!','texto'=>'Se restauró correctamente']);
    }
}
