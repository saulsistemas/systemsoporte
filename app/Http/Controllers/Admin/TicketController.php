<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Level;
use App\Models\Project;
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
        ->where('active','>','0')
        ->latest('id')
        ->paginate(10);
        return view('admin.tickets.index',compact('tickets','busqueda'));
    }

    public function create()
    {
        $users = User::where('id','>','1')
        ->latest('id')
        ->get();
        $services = Service::get();
        $contacts = Contact::pluck('name','id');
        $severity = [1=>'BAJA',2=>'MEDIA',3=>'ALTA'];
        return view('admin.tickets.create',compact('users','severity','services','contacts'));
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
        $ticket->service_id =$request->service_id;
        $ticket->category_id =$request->category_id;
        $ticket->subcategory_id =$request->subcategory_id;
        $ticket->client_id      =$request->client_id;
        //PARA EL USUARIO SOPORTE
        $user = auth()->user();
        $level_id= Level::where('user_id',$user->id)->first();
        
        $ticket->level_id       =$level_id->id;
        $ticket->contact_id     =$request->contact_id;
        $ticket->severity       =$request->severity;
        $ticket->start          =$request->start;
        $ticket->start_time     =date('H:i:s');
        $ticket->save();
        return redirect()->route('admin.tickets.index')->with(['estado'=>'success','titulo'=>'Guardado!','texto'=>'Se guardó correctamente']);

    }

    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show',compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $users = User::where('id','>','1')
        ->latest('id')
        ->get();
        $services = Service::get();
        $contacts = Contact::pluck('name','id');
        $severity = [1=>'BAJA',2=>'MEDIA',3=>'ALTA'];
        return view('admin.tickets.edit',compact('ticket','users','severity','services','contacts'));
    }

    public function update(Request $request, Ticket $ticket)
    {
       
        $ticket->title          =$request->title;
        $ticket->description    =$request->description;
        $ticket->service_id     =$request->service_id;
        $ticket->category_id    =$request->category_id;
        $ticket->subcategory_id =$request->subcategory_id;
        $ticket->client_id      =$request->client_id;
        $ticket->contact_id      =$request->contact_id;
        $ticket->severity       =$request->severity;
        $ticket->start          =$request->start;
        $ticket->start_time     =date('H:i:s');
        $ticket->save();
        return redirect()->route('admin.tickets.index')->with(['estado'=>'warning','titulo'=>'Modificado!','texto'=>'Se modificó correctamente']);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('admin.tickets.index')->with(['estado'=>'danger','titulo'=>'Eliminado!','texto'=>'Se eliminó correctamente']);
    }

    public function categoriesAll($id){
        return Category::where('service_id',$id)->get();
    }

    public function subcategoriesAll($id){
        return Subcategory::where('category_id',$id)->get();
    }

    public function atender(Ticket $ticket)
    {
        #validar de usuario de soporte;
        #poner validaciones video 27
        $ticket->support_id = auth()->user()->id;
        $ticket->assigned   = date('Y-m-d');
        $ticket->assigned_time   = date('H:i:s');
        $ticket->save();
        return back();
    }
    public function resolver(Request $request, Ticket $ticket)
    {
        $ticket->end   = date('Y-m-d');
        $ticket->end_time   = date('H:i:s');
        $ticket->solution   = $request->solution;
        $ticket->active   = 0;
        $ticket->save();
        return redirect()->route('admin.tickets.index')->with(['estado'=>'success','titulo'=>'Concluido!','texto'=>'Se finalizó atención correctamente']);
    }
}
