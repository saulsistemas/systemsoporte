<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Level;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class HomeController extends Controller
{
    public function index(Request $request ){
        #return $company_project_level =    DB::table('companies')
        #        ->selectRaw('companies.id, companies.name empresa ,projects.name proyecto,levels.name level')
        #        ->join('projects', 'companies.id', '=', 'projects.company_id')
        #        ->join('levels', 'projects.id', '=', 'levels.project_id')
        #        ->where('levels.user_id','=', $user->id)
        #        #->groupBy('companies.id')
        #        ->get();

        
        $user = auth()->user();
        $company_project_level='SELECT com.id as idempresa, com.name empresa ,pr.name proyecto,le.name level 
        FROM companies com
        INNER JOIN projects pr
        ON com.id = pr.company_id
        INNER JOIN levels le
        ON pr.id = le.project_id
        where le.user_id='.$user->id.'';
        $companies_projects_levels = DB::select($company_project_level);
        #datos de fechas actuales
        $day ='01';
        $month=Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        $start = $year.'-'.$month.'-'.$day;
        $end = Carbon::now()->format('Y-m-d');
        
        if ($request->company_id ||$request->start ||$request->end) {
            #return $request;
            if ($request->company_id && $request->start==null && $request->end == null) {#SI ENVIO ID PROJECTO
                $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id'.' WHERE u.company_id ='.$request->company_id.' 
                group by t.start';
                $total='SELECT u.company_id as empresa, count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE u.company_id ='.$request->company_id.' group by u.company_id' ;
            
            } else if($request->company_id && $request->start && $request->end == null) { #SI SOLO ENVIO FECHAS
                $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id'.' WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$request->start'".' AND '."'$end'".'
                group by t.start';
                $total='SELECT u.company_id as empresa, count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE u.company_id ='.$request->company_id.' AND  t.start BETWEEN  '."'$request->start'".' AND '."'$end'".'group by u.company_id';
            
            }elseif($request->company_id && $request->start && $request->end){
                $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id'.' WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$request->start'".' AND '."'$request->end'".'
                group by t.start';
                $total='SELECT u.company_id as empresa, count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE u.company_id ='.$request->company_id.' AND  t.start BETWEEN  '."'$request->start'".' AND '."'$request->end'".' group by u.company_id';

            }elseif($request->company_id && $request->start ==null && $request->end){#SI EXISTE COMPAÑIA Y FECHA FINAL JALA MES ACTUAL
                $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id'.' WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$start'".' AND '."'$request->end'".'
                group by t.start';
                $total='SELECT u.company_id as empresa, count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE u.company_id ='.$request->company_id.' AND t.start BETWEEN  '."'$start'".' AND '."'$request->end'".'group by u.company_id';

            }elseif($request->company_id==null && $request->start  && $request->end){
                $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id'.' WHERE  
                t.start BETWEEN  '."'$request->start'".' AND '."'$request->end'".'
                group by t.start';
                $total='SELECT  count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE  t.start BETWEEN  '."'$request->start'".' AND '."'$request->end'".'group by t.active>=0';

            }elseif($request->company_id==null && $request->start  && $request->end==null){
                $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id'.' WHERE  
                t.start BETWEEN  '."'$request->start'".' AND '."'$end'".'
                group by t.start';
                $total='SELECT  count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE  t.start BETWEEN  '."'$request->start'".' AND '."'$end'".' group by t.active>=0';

            }elseif($request->company_id==null && $request->start==null  && $request->end){
                $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id'.' WHERE  
                t.start BETWEEN  '."'$start'".' AND '."'$request->end'".'
                group by t.start';
                $total='SELECT  count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE t.start BETWEEN  '."'$start'".' AND '."'$request->end'".' group by t.active>=0';
            }
            
        }else{
            
            $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
            INNER JOIN USERS u
            ON u.id = t.client_id
            WHERE t.start BETWEEN  '."'$start'".' AND '."'$end'".'
            group by start;';
            $total ='SELECT  count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE t.start BETWEEN  '."'$start'".' AND '."'$end'".'
            group by t.active>=0';
        }
       
        $tickets = DB::select($slq);
        $totales = DB::select($total);
        $data=[];
        foreach ($tickets as $key=>$ticket) {
            $data['inicio'][]   = $ticket->inicio;
            $data['cantidad'][] = $ticket->cantidad;
        }
        $data['totales']=$totales;
        $data['data']= json_encode($data);
        return view('home.index',compact('companies_projects_levels'),$data);
        ##$mes =02;
        ##$anio=2022;
        ##$total_dia = Carbon::now()->month($mes)->daysInMonth;

        ##$slq='SELECT start ,count(id) cantidad FROM tickets group by start';
        #$slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
        #INNER JOIN USERS u
        #ON u.id = t.client_id
        #group by start;';
        #$tickets = DB::select($slq);
        ##$dia_inicio = $cantidad_tickets_dias->start;
       
        #$data=[];
        #foreach ($tickets as $key=>$ticket) {
        #    $data['inicio'][]   = $ticket->inicio;
        #    $data['cantidad'][] = $ticket->cantidad;
        #    
        #}
        ##$todos_los_dias = [];
        ##for ($i=1; $i <=$total_dia ; $i++) { 
        ##     $todos_los_dias[]=$anio.'-'.$mes.'-'.$i;
        ##    
        ##    if($todos_los_dias[$i-1] = $data['inicio']){
        ##        return $todos_los_dias;
        ##    }
        ##}
        # #$array_resultante= array_merge($data['inicio'],$todos_los_dias);
        # #return $unicos = array_unique($array_resultante);


        ##$data['todos']= $todos_los_dias;
    
        #$data['data']= json_encode($data);
        #return view('home.index',compact('companies_projects_levels'),$data);
    }
}
