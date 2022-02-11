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
        <input type="date" name="fecha" id="fecha" class="form-control" value="">
        <div id="grafico" style="margin: 0 auto"></div>
                     
    </div>
</div>
@stop



@section('js')
    <script src="{{ asset('vendor/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('vendor/highcharts/exporting.js') }}"></script>
    <script>
        $('#fecha').on('change', function (e) {
            var fecha = $(this).val();
            var dia = fecha.slice(-2);
            console.log(dia);
            datagrafico(dia);
        })

        function  datagrafico (dia){
            var namesMonth= [];
            var meses = new Array();
            for (let i = 1; i <= dia; i++) {
                namesMonth[i]=i;
                
            }
           
            categories= [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ]
        meses.push(categories.length -1)
            console.log(namesMonth,meses,2021);
            //graficar(categories,namesMonth,2021);

            //namesMonth =["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];
            //  $.ajax({
            //        url: base_url + "cdashboard/getdata",
            //        type: "POST",
            //        data:{year:year},
            //        dataType:"json",                   
            //        success:function(data){
            //            var meses = new Array();
            //            var montos = new Array();                        
            //           $.each(data,function(key,value){
            //            meses.push(namesMonth[value.mes - 1]);
            //            valor = Number(value.monto);
            //            montos.push(valor);
            //           }) ;
            //           graficar(meses,montos,year);
            //        }
            //    });
        } 

      
        function graficar (meses,montos,year) {
            $('#grafico').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Cantidad de Ordenes de Cotización'
                },
                subtitle: {
                    text: 'Año ' + year
                },
                xAxis: {
                    categories: meses,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Cantidad Acumulada'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' +
                        '<td style="padding:0"><b>{point.y:.2f} soles</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    },series:{
                        dataLabels:{
                            enabled:true,
                            formatter:function(){
                                return Highcharts.numberFormat(this.y,2)
                            }
                        }
                    }
                },
                series: [{
                    name: 'Meses',
                    data: montos,
                    color: '#00a65a'
        
                }]
            });
    };
    </script>
@stop