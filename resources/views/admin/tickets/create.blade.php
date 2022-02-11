@extends('adminlte::page')

@section('title', 'Tickets')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="card bg-light mb-3" >
    <div class="card-header">
        <h3 class="card-title">Crear Tickets</h3>
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
        {!! Form::open(['route'=> 'admin.tickets.store','autocomplete'=>'off']) !!}
            @include('admin.tickets.includes.formadd')
            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap-5-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap-5-theme.rtl.min.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
    <script>
       $(document).ready(function() {
           $('.client_class').select2({theme: "bootstrap-5"});
           $('.severt_class').select2({theme: "bootstrap-5"});
           $('#select_service').select2({theme: "bootstrap-5"});
           $('#select_category').select2({theme: "bootstrap-5"});
           $('#select_subcategory').select2({theme: "bootstrap-5"});
           
           //CLICK EN SERVICIOS
           $('#select_service').on('change', function (e) {
                var service_id = $(this).val();
                if(!service_id){
                    $('#select_category').html('<option value="">Seleccione Categoría</option>');
                    $('#select_subcategory').html('<option value="">Seleccione Subcategoría</option>');
                    return;
                }
                //SI SELECCIONO OTRO ITEM LA ULTMIMA CATEGORIA SE BORRA
                $('#select_subcategory').html('<option value="">Seleccione Subcategoría</option>');
                //ajax
                $.get('/admin/tickets/'+service_id+'/categories',function(data){
                    var html_select = '<option value="">Seleccione Categoría</option>';
                    for (let i = 0; i < data.length; i++) {
                        html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                    }
                    $('#select_category').html(html_select);
                })
            })
            //CLICK EN CATEGORIAS
            $('#select_category').on('change', function (e) {
                var category_id = $(this).val();
                if(!category_id ){
                    $('#select_subcategory').html('<option value="">Seleccione Subcategoría</option>');
                    return;
                }
                //ajax
                $.get('/admin/tickets/'+category_id+'/subcategories',function(data){
                    var html_select = '<option value="">Seleccione Subcategoría</option>';
                    for (let i = 0; i < data.length; i++) {
                        html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                    }
                    $('#select_subcategory').html(html_select);
                })
            })
       });
    </script>
@stop