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
                $user_sql='SELECT u.company_id as empresa,u.name,u.last_name, count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE u.company_id ='.$request->company_id.' group by u.company_id, u.id,u.name,u.last_name order by cantidad desc';
                $servicios='SELECT sv.id servicio_id,cp.name as empresa,sv.name as servicios, count(t.id) as cantidad 
                FROM tickets t 
                INNER JOIN USERS u ON u.id = t.client_id 
                INNER JOIN companies cp ON cp.id = u.company_id 
                INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
                INNER JOIN categories ct ON ct.id = sc.category_id 
                INNER JOIN services sv ON sv.id = ct.service_id 
                WHERE u.company_id ='.$request->company_id.' 
                group by servicio_id,empresa,servicios order by cantidad desc';
                $categorias='SELECT ct.id categoria_id,cp.name as empresa,sv.name servicios, ct.name as categorias, sc.name as subcategorias,count(t.id) as cantidad 
                FROM tickets t 
                INNER JOIN USERS u ON u.id = t.client_id 
                INNER JOIN companies cp ON cp.id = u.company_id 
                INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
                INNER JOIN categories ct ON ct.id = sc.category_id 
                INNER JOIN services sv ON sv.id = ct.service_id 
                WHERE u.company_id ='.$request->company_id.' 
                group by categoria_id,empresa,servicios,categorias,subcategorias order by cantidad desc';
                
            } else if($request->company_id && $request->start && $request->end == null) { #SI SOLO ENVIO FECHAS
                $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id'.' WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$request->start'".' AND '."'$end'".'
                group by t.start';
                $total='SELECT u.company_id as empresa, count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE u.company_id ='.$request->company_id.' AND  t.start BETWEEN  '."'$request->start'".' AND '."'$end'".'group by u.company_id';
                $user_sql='SELECT u.company_id as empresa,u.name,u.last_name, count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$request->start'".' AND '."'$end'".'
                group by u.company_id, u.id,u.name,u.last_name order by cantidad desc';
                $servicios='SELECT sv.id servicio_id,cp.name as empresa,sv.name as servicios, count(t.id) as cantidad 
                FROM tickets t 
                INNER JOIN USERS u ON u.id = t.client_id 
                INNER JOIN companies cp ON cp.id = u.company_id 
                INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
                INNER JOIN categories ct ON ct.id = sc.category_id 
                INNER JOIN services sv ON sv.id = ct.service_id 
                WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$request->start'".' AND '."'$end'".'
                group by servicio_id,empresa,servicios order by cantidad desc';
                $categorias='SELECT ct.id categoria_id,cp.name as empresa,sv.name servicios,ct.name as categorias, sc.name as subcategorias,count(t.id) as cantidad 
                FROM tickets t 
                INNER JOIN USERS u ON u.id = t.client_id 
                INNER JOIN companies cp ON cp.id = u.company_id 
                INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
                INNER JOIN categories ct ON ct.id = sc.category_id 
                INNER JOIN services sv ON sv.id = ct.service_id 
                WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$request->start'".' AND '."'$end'".'
                group by categoria_id,empresa,servicios,categorias,subcategorias order by cantidad desc';
           
            }elseif($request->company_id && $request->start && $request->end){
                $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id'.' WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$request->start'".' AND '."'$request->end'".'
                group by t.start';
                $total='SELECT u.company_id as empresa, count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE u.company_id ='.$request->company_id.' AND  t.start BETWEEN  '."'$request->start'".' AND '."'$request->end'".' group by u.company_id';
                $user_sql='SELECT u.company_id as empresa,u.name,u.last_name,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$request->start'".' AND '."'$request->end'".'
                group by u.company_id, u.id,u.name,u.last_name order by cantidad desc';
                $servicios='SELECT sv.id servicio_id,cp.name as empresa,sv.name as servicios, count(t.id) as cantidad 
                FROM tickets t 
                INNER JOIN USERS u ON u.id = t.client_id 
                INNER JOIN companies cp ON cp.id = u.company_id 
                INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
                INNER JOIN categories ct ON ct.id = sc.category_id 
                INNER JOIN services sv ON sv.id = ct.service_id 
                WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$request->start'".' AND '."'$request->end'".'
                group by servicio_id,empresa,servicios order by cantidad desc';
                $categorias='SELECT ct.id categoria_id,cp.name as empresa,sv.name servicios,ct.name as categorias, sc.name as subcategorias,count(t.id) as cantidad 
                FROM tickets t 
                INNER JOIN USERS u ON u.id = t.client_id 
                INNER JOIN companies cp ON cp.id = u.company_id 
                INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
                INNER JOIN categories ct ON ct.id = sc.category_id 
                INNER JOIN services sv ON sv.id = ct.service_id 
                WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$request->start'".' AND '."'$request->end'".'
                group by categoria_id,empresa,servicios,categorias,subcategorias order by cantidad desc';

            }elseif($request->company_id && $request->start ==null && $request->end){#SI EXISTE COMPAÑIA Y FECHA FINAL JALA MES ACTUAL
                $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id'.' WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$start'".' AND '."'$request->end'".'
                group by t.start';
                $total='SELECT u.company_id as empresa, count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE u.company_id ='.$request->company_id.' AND t.start BETWEEN  '."'$start'".' AND '."'$request->end'".'group by u.company_id';
                $user_sql='SELECT u.company_id as empresa,u.name,u.last_name,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$start'".' AND '."'$request->end'".'
                group by u.company_id, u.id,u.name,u.last_name order by cantidad desc';
                $servicios='SELECT sv.id servicio_id,cp.name as empresa,sv.name as servicios, count(t.id) as cantidad 
                FROM tickets t 
                INNER JOIN USERS u ON u.id = t.client_id 
                INNER JOIN companies cp ON cp.id = u.company_id 
                INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
                INNER JOIN categories ct ON ct.id = sc.category_id 
                INNER JOIN services sv ON sv.id = ct.service_id 
                WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$start'".' AND '."'$request->end'".'
                group by servicio_id,empresa,servicios order by cantidad desc';
                $categorias='SELECT ct.id categoria_id,cp.name as empresa,sv.name servicios,ct.name as categorias, sc.name as subcategorias,count(t.id) as cantidad 
                FROM tickets t 
                INNER JOIN USERS u ON u.id = t.client_id 
                INNER JOIN companies cp ON cp.id = u.company_id 
                INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
                INNER JOIN categories ct ON ct.id = sc.category_id 
                INNER JOIN services sv ON sv.id = ct.service_id 
                WHERE u.company_id ='.$request->company_id.' AND 
                t.start BETWEEN  '."'$start'".' AND '."'$request->end'".'
                group by categoria_id,empresa,servicios,categorias,subcategorias order by cantidad desc';

            }elseif($request->company_id==null && $request->start  && $request->end){
                $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id'.' WHERE  
                t.start BETWEEN  '."'$request->start'".' AND '."'$request->end'".'
                group by t.start';
                $total='SELECT  count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE  t.start BETWEEN  '."'$request->start'".' AND '."'$request->end'".'group by t.active>=0';
                $user_sql='SELECT u.company_id as empresa,u.name,u.last_name, count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id WHERE  
                t.start BETWEEN  '."'$request->start'".' AND '."'$request->end'".'
                group by u.company_id, u.id,u.name,u.last_name order by cantidad desc';
                $servicios='SELECT sv.id servicio_id,cp.name as empresa,sv.name as servicios, count(t.id) as cantidad 
                FROM tickets t 
                INNER JOIN USERS u ON u.id = t.client_id 
                INNER JOIN companies cp ON cp.id = u.company_id 
                INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
                INNER JOIN categories ct ON ct.id = sc.category_id 
                INNER JOIN services sv ON sv.id = ct.service_id 
                WHERE t.start BETWEEN  '."'$request->start'".' AND '."'$request->end'".'
                group by servicio_id,empresa,servicios order by cantidad desc';
                $categorias='SELECT ct.id categoria_id,cp.name as empresa,sv.name servicios,ct.name as categorias, sc.name as subcategorias,count(t.id) as cantidad 
                FROM tickets t 
                INNER JOIN USERS u ON u.id = t.client_id 
                INNER JOIN companies cp ON cp.id = u.company_id 
                INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
                INNER JOIN categories ct ON ct.id = sc.category_id 
                INNER JOIN services sv ON sv.id = ct.service_id 
                WHERE t.start BETWEEN  '."'$request->start'".' AND '."'$request->end'".'
                group by categoria_id,empresa,servicios,categorias,subcategorias order by cantidad desc';

            }elseif($request->company_id==null && $request->start  && $request->end==null){
                $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id'.' WHERE  
                t.start BETWEEN  '."'$request->start'".' AND '."'$end'".'
                group by t.start';
                $total='SELECT  count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE  t.start BETWEEN  '."'$request->start'".' AND '."'$end'".' group by t.active>=0';
                $user_sql='SELECT u.company_id as empresa,u.name,u.last_name, count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id  WHERE  
                t.start BETWEEN  '."'$request->start'".' AND '."'$end'".'
                group by u.company_id, u.id,u.name,u.last_name order by cantidad desc';
                $servicios='SELECT sv.id servicio_id,cp.name as empresa,sv.name as servicios, count(t.id) as cantidad 
                FROM tickets t 
                INNER JOIN USERS u ON u.id = t.client_id 
                INNER JOIN companies cp ON cp.id = u.company_id 
                INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
                INNER JOIN categories ct ON ct.id = sc.category_id 
                INNER JOIN services sv ON sv.id = ct.service_id 
                WHERE t.start BETWEEN  '."'$request->start'".' AND '."'$end'".'
                group by servicio_id,empresa,servicios order by cantidad desc';
                $categorias='SELECT ct.id categoria_id,cp.name as empresa,sv.name servicios,ct.name as categorias, sc.name as subcategorias,count(t.id) as cantidad 
                FROM tickets t 
                INNER JOIN USERS u ON u.id = t.client_id 
                INNER JOIN companies cp ON cp.id = u.company_id 
                INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
                INNER JOIN categories ct ON ct.id = sc.category_id 
                INNER JOIN services sv ON sv.id = ct.service_id 
                WHERE t.start BETWEEN  '."'$request->start'".' AND '."'$end'".'
                group by categoria_id,empresa,servicios,categorias,subcategorias order by cantidad desc';

            }elseif($request->company_id==null && $request->start==null  && $request->end){
                $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id'.' WHERE  
                t.start BETWEEN  '."'$start'".' AND '."'$request->end'".'
                group by t.start';
                $total='SELECT  count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE t.start BETWEEN  '."'$start'".' AND '."'$request->end'".' group by t.active>=0';
                $user_sql='SELECT u.company_id as empresa,u.name,u.last_name, count(t.id) as cantidad FROM tickets t
                INNER JOIN USERS u
                ON u.id = t.client_id  WHERE  
                t.start BETWEEN  '."'$start'".' AND '."'$request->end'".'
                group by u.company_id, u.id,u.name,u.last_name order by cantidad desc';
                $servicios='SELECT sv.id servicio_id,cp.name as empresa,sv.name as servicios, count(t.id) as cantidad 
                FROM tickets t 
                INNER JOIN USERS u ON u.id = t.client_id 
                INNER JOIN companies cp ON cp.id = u.company_id 
                INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
                INNER JOIN categories ct ON ct.id = sc.category_id 
                INNER JOIN services sv ON sv.id = ct.service_id 
                WHERE t.start BETWEEN  '."'$start'".' AND '."'$request->end'".'
                group by servicio_id,empresa,servicios order by cantidad desc';
                $categorias='SELECT ct.id categoria_id,cp.name as empresa,sv.name servicios,ct.name as categorias, sc.name as subcategorias,count(t.id) as cantidad 
                FROM tickets t 
                INNER JOIN USERS u ON u.id = t.client_id 
                INNER JOIN companies cp ON cp.id = u.company_id 
                INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
                INNER JOIN categories ct ON ct.id = sc.category_id 
                INNER JOIN services sv ON sv.id = ct.service_id 
                WHERE t.start BETWEEN  '."'$start'".' AND '."'$request->end'".'
                group by categoria_id,empresa,servicios,categorias,subcategorias order by cantidad desc';

            }
            
        }else{
            
            $slq='SELECT t.start as inicio,count(t.id) as cantidad FROM tickets t
            INNER JOIN USERS u
            ON u.id = t.client_id
            WHERE t.start BETWEEN  '."'$start'".' AND '."'$end'".'
            group by start;';
            $total ='SELECT  count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE t.start BETWEEN  '."'$start'".' AND '."'$end'".'
            group by t.active>=0';
            $user_sql='SELECT u.company_id as empresa,u.name,u.last_name, count(t.id) as cantidad FROM tickets t INNER JOIN USERS u ON u.id = t.client_id WHERE t.start BETWEEN  '."'$start'".' AND '."'$end'".' group by u.company_id, u.id,u.name,u.last_name order by cantidad desc';
            $servicios='SELECT sv.id servicio_id,cp.name as empresa,sv.name as servicios, count(t.id) as cantidad 
            FROM tickets t 
            INNER JOIN USERS u ON u.id = t.client_id 
            INNER JOIN companies cp ON cp.id = u.company_id 
            INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
            INNER JOIN categories ct ON ct.id = sc.category_id 
            INNER JOIN services sv ON sv.id = ct.service_id 
            WHERE t.start BETWEEN  '."'$start'".' AND '."'$end'".'
            group by servicio_id,empresa,servicios order by cantidad desc';
            $categorias='SELECT ct.id categoria_id,cp.name as empresa,sv.name servicios,ct.name as categorias, sc.name as subcategorias,count(t.id) as cantidad 
            FROM tickets t 
            INNER JOIN USERS u ON u.id = t.client_id 
            INNER JOIN companies cp ON cp.id = u.company_id 
            INNER JOIN subcategories sc ON sc.id = t.subcategory_id 
            INNER JOIN categories ct ON ct.id = sc.category_id 
            INNER JOIN services sv ON sv.id = ct.service_id 
            WHERE t.start BETWEEN  '."'$start'".' AND '."'$end'".'
            group by categoria_id,empresa,servicios,categorias,subcategorias order by cantidad desc';
        }
       
        $tickets = DB::select($slq);
        $totales = DB::select($total);
        $usuarios = DB::select($user_sql);
        $services = DB::select($servicios);
        $categories = DB::select($categorias);
        $data=[];
        foreach ($tickets as $key=>$ticket) {
            $data['inicio'][]   = $ticket->inicio;
            $data['cantidad'][] = $ticket->cantidad;
        }
        $data['totales']=$totales;
        $data['data']= json_encode($data);
        return view('home.index',compact('companies_projects_levels','usuarios','services','categories'),$data);
        
    }
}
