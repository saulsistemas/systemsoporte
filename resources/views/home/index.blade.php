@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="card bg-light mb-3" >
    <div class="card-header">
        <h3 class="card-title">REPORTE</h3>
        <div class="card-tools">
            <a href="{{ route('admin.home') }}" class="btn btn-tool" >
                <i class="fas fa-sync-alt"></i>
            </a>
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
              <i class="fas fa-expand"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <div class="card-body">
        {{  auth()->user()->office->company->name;}}
        <form action="{{ route('admin.home') }}" method="GET">
            <div class="form-group row">
                <label class="col-sm-2" for="start">FECHA INICIO :</label>
                <div class="col-sm-10">
                    <input type="date" name="start" id="start" class="form-control" value="<?php if(isset($_GET['start'])) echo $_GET['start']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" for="end">FECHA FIN :</label>
                <div class="col-sm-10">
                    <input type="date" name="end" id="end" class="form-control" value="<?php if(isset($_GET['end'])) echo $_GET['end']; ?>">
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-sm-2" for="end">Proyecto :</label>
                <div class="col-sm-10">
                    <select name="company_id" id="select_company" class="form-control" >
                        <option value="">Seleccione proyecto</option>
                        @foreach ($companies_projects_levels as $company)
                            @if (isset($_GET['company_id']) && $_GET['company_id'] == $company->idempresa)
                                <option value="{{$company->idempresa}}" selected>{{$company->proyecto}}</option>
                            @else
                                <option value="{{$company->idempresa}}" >{{$company->proyecto}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" >Consultar</button>
        </form>
        <canvas id="myChart" height="60"></canvas>
           
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card bg-light mb-3" >
            <div class="card-header">
                <h3 class="card-title">CANTIDAD DE ATENCIONES POR USUARIO</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>CANTIDAD</th>
                    </thead>
                    <tbody>
                        <?php  $total=0; ?>
                        @foreach ($usuarios as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->cantidad;}}</td>
                                <?php $total=$total+$user->cantidad ?>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"> <h2>TOTAL {{$total}}</h2> </td>
                        </tr>
                    </tfoot>    
                </table>  
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-light mb-3" >
            <div class="card-header">
                <h3 class="card-title">CANTIDAD DE SERVICIOS</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th>EMPRESA</th>
                        <th>NOMBRE</th>
                        <th>CANTIDAD</th>
                        {{-- <th>INFO</th> --}}
                    </thead>
                    <tbody>
                        <?php  $total=0; ?>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{$service->empresa}}</td>
                                <td>{{$service->servicios}}</td>
                                <td>{{$service->cantidad;}}</td>
                                {{-- <td><a class="btn btn-primary" href="#" value="{{$service->servicio_id}}"><i class="fas fa-ticket-alt"></i></a></td> --}}
                                
                                <?php $total=$total+$service->cantidad ?>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"> <h2>TOTAL {{$total}}</h2> </td>
                        </tr>
                    </tfoot>    
                </table>  
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-light mb-3" >
            <div class="card-header">
                <h3 class="card-title">CANTIDAD DE CATEGORIAS</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>CATEGORIA</th>
                        <th>SUBCATEGORIA</th>
                        <th>CANTIDAD</th>
                        {{-- <th>INFO</th> --}}
                    </thead>
                    <tbody>
                        <?php  $total=0; ?>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->categorias}}</td>
                                <td>{{$category->subcategorias}}</td>
                                <td>{{$category->cantidad;}}</td>
                                {{-- <td><a class="btn btn-primary" href="#" value="{{$category->servicio_id}}"><i class="fas fa-ticket-alt"></i></a></td> --}}
                                
                                <?php $total=$total+$category->cantidad ?>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"> <h2>TOTAL {{$total}}</h2> </td>
                        </tr>
                    </tfoot>    
                </table>  
                </div>
            </div>
        </div>
    </div>
</div>

@stop



@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    {{-- <script src="{{ asset('project/home/home.js') }}"></script> --}}
 <script>
 const ctx = document.getElementById('myChart').getContext('2d');
const cData = JSON.parse('<?php echo $data;?>');
console.log(cData);
console.log(cData.totales[0].cantidad);
ctx.height = 100;

const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: cData.inicio,
        datasets: [{
            label: 'TOTAL TIKETS = '+cData.totales[0].cantidad,
            data: cData.cantidad,
            //data: [12, 13, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            tension: 0.1
        }]
    },
    options: {
        
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});   
 </script>
@stop