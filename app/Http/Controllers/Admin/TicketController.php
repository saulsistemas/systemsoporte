<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Models\Subcategory;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct()
    {
        #ESTO FUNCIONA PARA EL CONTROLADOR - SE TIENE QUE PONER CASO CONTRARIO ACCEDEN POR LA RUTA
        $this->middleware('can:admin.tickets.index')->only('index');
        $this->middleware('can:admin.tickets.create')->only('create','store');
        $this->middleware('can:admin.tickets.edit')->only('edit','update');
        $this->middleware('can:admin.tickets.destroy')->only('destroy');
        $this->middleware('can:admin.tickets.restore')->only('restore');
    }
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $tickets=Ticket::where('title','LIKE','%'.$busqueda.'%')
        ->orWhere('description','LIKE','%'.$busqueda.'%')
        ->latest('id')
        ->paginate(10);
        return view('admin.tickets.index',compact('tickets','busqueda'));
    }

    public function create()
    {
        $users = User::where('id','>','1')
        ->latest('id')
        ->get();
        $services = Service::latest('id')
        ->get();
        $severity = [1=>'BAJA',2=>'MEDIA',3=>'ALTA'];
        return view('admin.tickets.create',compact('users','severity','services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            #'service_id '=>'required',
            #'client_id'=>'required',
            #'description '=>'required',
            #'start'=>'required',
        ]);
        $ticket = new Ticket();
        $ticket->title          =$request->title;
        $ticket->description    =$request->description;
        $ticket->subcategory_id =$request->subcategory_id;
        $ticket->client_id      =$request->client_id;
        $ticket->severity       =$request->severity;
        $ticket->start          =$request->start;
        $ticket->start_time     =date('H:i:s');;
        $ticket->save();
        return redirect()->route('admin.tickets.index')->with(['estado'=>'success','titulo'=>'Guardado!','texto'=>'Se guardó correctamente']);

    }

    public function show(Ticket $ticket)
    {
        //
    }

    public function edit(Ticket $ticket)
    {
        //
    }

    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    public function destroy(Ticket $ticket)
    {
        //
    }

    public function categoriesAll($id){
        return Category::where('service_id',$id)->latest('id')->get();
    }

    public function subcategoriesAll($id){
        return Subcategory::where('category_id',$id)->latest('id')->get();
    }
}
