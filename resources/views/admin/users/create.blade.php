@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="card bg-light mb-3" >
    <div class="card-header">
        <h3 class="card-title">Crear Usuarios</h3>
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
        {!! Form::open(['route'=> 'admin.users.store','autocomplete'=>'off']) !!}
            @include('admin.users.includes.formadd')
            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script> 
    $(document).ready(function() { 
        load_select_company();
        $('#select_company').on('change', function () {//CLICK EN SERVICIOS
            var company_id = $(this).val();
            mostrar_sede(company_id);
            mostrar_area(company_id);
        })  
    });
    function load_select_company(){
        var company_id = $('#select_company').val();
        mostrar_sede(company_id);
        mostrar_area(company_id);
    }
    //OFICINAS
    function mostrar_sede(company_id){
        if(!company_id){ //SI SELECCIONO OTRO ITEM LA ULTMIMA CATEGORIA SE BORRA
            $('#select_office').html('<option value="">Seleccione sede</option>');
            return;
        }//ajax
        $.get('/admin/users/'+company_id+'/offices',function(data){
            var html_select = '<option value="">Seleccione sede</option>';
            for (let i = 0; i < data.length; i++) {
                html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
            }
            $('#select_office').html(html_select);
        })
    }
    //AREAS
    function mostrar_area(company_id){
        if(!company_id){ //SI SELECCIONO OTRO ITEM LA ULTMIMA CATEGORIA SE BORRA
            $('#select_area').html('<option value="">Seleccione área</option>');
            return;
        }//ajax
        $.get('/admin/users/'+company_id+'/areas',function(data){
            var html_select = '<option value="">Seleccione área</option>';
            for (let i = 0; i < data.length; i++) {
                html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
            }
            $('#select_area').html(html_select);
        })
    }
</script>
@stop