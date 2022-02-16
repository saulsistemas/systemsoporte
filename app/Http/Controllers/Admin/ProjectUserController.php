<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectUser;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
    
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $projectusers=ProjectUser::where('id','LIKE','%'.$busqueda.'%')
        ->withTrashed() #se visualizan los eliminados
        ->latest('id')
        ->paginate(10);
        return view('admin.projectusers.index',compact('projectusers','busqueda'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
