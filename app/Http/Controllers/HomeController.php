<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $mes =02;
        $anio=2022;
        $total_dia = Carbon::now()->month($mes)->daysInMonth;

        $slq='SELECT start ,count(id) cantidad FROM tickets group by start';
        $tickets = DB::select($slq);
        #$dia_inicio = $cantidad_tickets_dias->start;
       
        $data=[];
        foreach ($tickets as $key=>$ticket) {
            $data['inicio'][] = $ticket->start;
            $data['cantidad'][] = $ticket->cantidad;
            
        }
        #$todos_los_dias = [];
        #for ($i=1; $i <=$total_dia ; $i++) { 
        #     $todos_los_dias[]=$anio.'-'.$mes.'-'.$i;
        #    
        #    if($todos_los_dias[$i-1] = $data['inicio']){
        #        return $todos_los_dias;
        #    }
        #}
         #$array_resultante= array_merge($data['inicio'],$todos_los_dias);
         #return $unicos = array_unique($array_resultante);


        #$data['todos']= $todos_los_dias;
    
        $data['data']= json_encode($data);
        return view('home.index',$data);
    }
}
