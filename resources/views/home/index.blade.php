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
            <a href="{{ route('admin.roles.index') }}" class="btn btn-tool" >
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
        <input type="date" name="fecha" id="fecha" class="form-control" value="">
        
            <canvas id="myChart" ></canvas>
           
    </div>
</div>
@stop



@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script>

        const ctx = document.getElementById('myChart').getContext('2d');
        const cData = JSON.parse('<?php echo $data;?>');
        console.log(cData);
        ctx.height = 100;
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: cData.inicio,
                datasets: [{
                    label: '# DIAS DE LA SEMANA',
                    data: cData.cantidad,
                    //data: [12, 13, 3, 5, 2, 3],
                    borderColor: 'rgb(75, 192, 192)',
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