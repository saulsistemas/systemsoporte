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
        $user=auth()->user();
        $busqueda = $request->busqueda;
        $tickets=Ticket::where('title','LIKE','%'.$busqueda.'%')
        ->where('active','>','0')
        ->where('support_id',null)
        ->latest('id')
        ->paginate(4);

        $my_tickets=Ticket::where('support_id',$user->id)
        ->where('active','>','0')
        ->latest('id')
        ->get();

        $solution_tickets=Ticket::where('support_id',$user->id)
        ->where('active','<','1')
        ->latest('id')
        ->take(10)
        ->get();
      

        return view('admin.tickets.index',compact('tickets','busqueda','my_tickets','solution_tickets'));
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
        if ($level_id) {
            $ticket->level_id       =$level_id->id;
        }else{
            return redirect()->route('admin.tickets.index')->with(['estado'=>'warning','titulo'=>'error!','texto'=>'No tiene asignado nivel en proyecto']);
        }
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
        $company_id = $ticket->client->company_id;
        $project_id =Project::where('company_id',$company_id)->first()->id;
        $level_exist= Level::where('user_id',auth()->user()->id)->first();
                           
        if (!empty($level_exist)) {
            $level_id= Level::where('user_id',auth()->user()->id)
                        ->where('project_id',$project_id )->first()->id; 
            $ticket->level_id = $level_id;
            $ticket->support_id = auth()->user()->id;
            $ticket->assigned   = date('Y-m-d');
            $ticket->assigned_time   = date('H:i:s');
            $ticket->save();
            return back()->with(['estado'=>'success','titulo'=>'Correcto!','texto'=>'Se te asignó incidencia']);
        } else {
            return back()->with(['estado'=>'danger','titulo'=>'Error!','texto'=>'no esta asignado a proyecto']);
        }
        
        
    }
    public function resolver(Request $request, Ticket $ticket)
    {
        
        $ticket->end   = $request->end;
        $ticket->end_time   = date('H:i:s');
        $ticket->solution   = $request->solution;
        $ticket->active   = 0;
        $ticket->save();
        return redirect()->route('admin.tickets.index')->with(['estado'=>'success','titulo'=>'Concluido!','texto'=>'Se finalizó atención correctamente']);
    }
    public function abrir(Ticket $ticket)
    {
        $ticket->active   = 1;
        $ticket->open   = date('Y-m-d');
        $ticket->open_time   = date('H:i:s');
        $ticket->save();
        return redirect()->route('admin.tickets.index')->with(['estado'=>'success','titulo'=>'Concluido!','texto'=>'Se cambio de estado la atención correctamente']);
    }
    public function derivar(Ticket $ticket)
    {
        #siempre tiene que traer al level principal porque de ahi comienza todo
        $level_id= $ticket->level_id;

        $company_id = $ticket->client->company_id;
        $project = Project::where('company_id',$company_id)->first();#OBTENER TODO LOS PRYECTOS SEGUN EMPRESA DEL USUARIO
        $levels = $project->levels;#TODO LOS LEVELES

        ##Busca el nivel actual y le paso todo los leveles
        $next_level_id = $this->getNextLevelId($level_id,$levels);
        #si existe otro nivel lo guardamos
        if ($next_level_id) {
            $ticket->level_id = $next_level_id;
            $ticket->support_id = null;
            $ticket->save();
            return redirect()->route('admin.tickets.index')->with(['estado'=>'success','titulo'=>'Derivado!','texto'=>'Se derivó atención correctamente']);
        }
        return back()->with('notificacion','no es posible porque no hay siguiente nivel');
    }
    public function getNextLevelId($level_id,$levels){
        $tamanio_levels =sizeof($levels);
        if (sizeof($levels)<=1) {
            return null;
        }
        $position=null;
        for ($i=0; $i < $tamanio_levels; $i++) { 
            if ($levels[$i]->id ==$level_id) {
                $position=$i;#Guarda la vuelta u posicion
                break;
            }
        }
        if ($position == -1) {
            return null;
        }
        #1 =3-1=2
        if ($position == $tamanio_levels -1) {
            return null;
        }
        #dd($levels[$i+1]);#ingreso al array con la posicion encontrada y lo envio
        return $levels[$position+1]->id;
    }
}
