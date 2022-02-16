<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class LevelController extends Controller
{
    public function __construct()
    {
        #ESTO FUNCIONA PARA EL CONTROLADOR - SE TIENE QUE PONER CASO CONTRARIO ACCEDEN POR LA RUTA
        $this->middleware('can:admin.levels.index')->only('index');
        $this->middleware('can:admin.levels.create')->only('create','store');
        $this->middleware('can:admin.levels.edit')->only('edit','update');
        $this->middleware('can:admin.levels.destroy')->only('destroy');
    }
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $levels=Level::where('name','LIKE','%'.$busqueda.'%')
        ->latest('id')
        ->paginate(10);
        return view('admin.levels.index',compact('levels','busqueda'));
    }
    
    public function create()
    {
        $projects = Project::pluck('name','id');
        return view('admin.levels.create',compact('projects'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $level = new Level();
        $level->project_id  =$request->project_id;
        $level->name  =$request->name;
        $level->save();
        return redirect()->route('admin.levels.index')->with(['estado'=>'success','titulo'=>'Guardado!','texto'=>'Se guardó correctamente']);
    }
 
    public function show(Level $level)
    {
        //
    }
   
    public function edit(Level $level)
    {
        $projects = Project::pluck('name','id');
        return view('admin.levels.edit',compact('level','projects'));
    }

    public function update(Request $request, Level $level)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $level->update($request->all());
        return redirect()->route('admin.levels.index')->with(['estado'=>'warning','titulo'=>'Modificado!','texto'=>'Se modificó correctamente']);
    }

    public function destroy(Level $level)
    {
        $level->delete();
        return redirect()->route('admin.levels.index')->with(['danger'=>'success','titulo'=>'Eliminado!','texto'=>'Se eliminó correctamente']);
    }
}
