<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        #ESTO FUNCIONA PARA EL CONTROLADOR - SE TIENE QUE PONER CASO CONTRARIO ACCEDEN POR LA RUTA
        $this->middleware('can:admin.projects.index')->only('index');
        $this->middleware('can:admin.projects.create')->only('create','store');
        $this->middleware('can:admin.projects.edit')->only('edit','update');
        $this->middleware('can:admin.projects.destroy')->only('destroy');
        $this->middleware('can:admin.projects.restore')->only('restore');
    }
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $projects=Project::where('name','LIKE','%'.$busqueda.'%')
        ->withTrashed() #se visualizan los eliminados
        ->latest('id')
        ->paginate(10);
        return view('admin.projects.index',compact('projects','busqueda'));
    }

   
    public function create()
    {
        $companies = Company::where('active','=',1)->pluck('name','id');
        return view('admin.projects.create',compact('companies'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required'
        ]);
        $project_user =Project::where('company_id',$request->company_id)->first();
        if ($project_user) {
            return back()->with(['estado'=>'warning','titulo'=>'Notificación!','texto'=>'La empresa ya pertenece a este proyecto, solo puede agregar una empresa por proyecto , puede editar u eliminar']);
        }else{
            $project = new Project();
            $project->company_id  =$request->company_id;
            $project->name  =$request->name;
            $project->description  =$request->description;
            $project->start  =$request->start;
            $project->save();
            return redirect()->route('admin.projects.index')->with(['estado'=>'success','titulo'=>'Guardado!','texto'=>'Se guardó correctamente']);
        }
    }

   
    public function show(Project $project)
    {
        //
    }

  
    public function edit(Project $project)
    {
        $companies = Company::where('active','=',1)->pluck('name','id');
        return view('admin.projects.edit',compact('project','companies'));
    }

   
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required'
        ]);
        if ($request->name != $project->name ||$request->description != $project->description||$request->start != $project->start ) {
            $project->update($request->all());
            return redirect()->route('admin.projects.index')->with(['estado'=>'warning','titulo'=>'Modificado!','texto'=>'Se modificó correctamente']);
            
        }else{
            #si id por formulario = id base de datos
            $project_user =Project::where('company_id',$request->company_id)->first();
            if ($project_user) {
                return back()->with(['estado'=>'warning','titulo'=>'Notificación!','texto'=>'La empresa ya pertenece a este proyecto, solo puede agregar una empresa por proyecto , puede editar u eliminar']);
            }else{
                $project->update($request->all());
                return redirect()->route('admin.projects.index')->with(['estado'=>'warning','titulo'=>'Modificado!','texto'=>'Se modificó correctamente']);
            }
        }
       
    }

   
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with(['danger'=>'success','titulo'=>'Eliminado!','texto'=>'Se eliminó correctamente']);
    }

    public function restore($id)
    {
        Project::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.projects.index')->with(['estado'=>'success','titulo'=>'Restaurado!','texto'=>'Se restauró correctamente']);
    }
}
