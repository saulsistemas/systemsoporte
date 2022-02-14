@extends('adminlte::page')

@section('title', 'Tickets')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="card bg-light mb-3" >
    <div class="card-header">
        <h3 class="card-title">Editar Tickets</h3>
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
        {!! Form::model($ticket,['route'=>['admin.tickets.update',$ticket], 'autocomplete'=>'off','method'=>'put']) !!}
            @include('admin.tickets.includes.formedit')
            {!! Form::submit('Editar', ['class'=>'btn btn-success']) !!}
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
            load_select_service();
            
            //CLICK EN SERVICIOS
            $('#select_service').on('change', function (e) {
                var service_id = $(this).val();
                var category_id =null;
                mostrar_service(service_id,category_id);
            })  

            //CLICK EN CATEGORIA
            $('#select_category').on('change', function (e) {
                var category_id = $(this).val();
                var subcategory_id =null;
                mostrar_category(category_id,subcategory_id);
            })   

        });

        function load_select_service(){
            var service_id = $('#select_service').val();
            var category_id = $('#category_id').val();
            mostrar_service(service_id,category_id);
        }
        function mostrar_service(service_id,category_id=null){
            //SI SELECCIONO OTRO ITEM LA ULTMIMA CATEGORIA SE BORRA
            if(!service_id){
                $('#select_category').html('<option value="">Seleccione Categoría</option>');
                $('#select_subcategory').html('<option value="">Seleccione Subcategoría</option>');
                return;
            }
            //SI SELECCIONO OTRO ITEM LA ULTMIMA CATEGORIA SE BORRA
            $('#select_subcategory').html('<option value="">Seleccione Subcategoría</option>');
            //ajax
            if (service_id && category_id) {
                $.get('/admin/tickets/'+service_id+'/categories',function(data){
                var html_select = '<option value="">Seleccione Categoría</option>';
                    for (let i = 0; i < data.length; i++) {
                        if (data[i].id == category_id) {
                            html_select += '<option value="'+data[i].id+'" selected>'+data[i].name+'</option>';
                        }else{
                            html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                        }
                    }
                    $('#select_category').html(html_select);
                    load_select_category();
                })
            }else{
                $.get('/admin/tickets/'+service_id+'/categories',function(data){
                var html_select = '<option value="">Seleccione Categoría</option>';
                    for (let i = 0; i < data.length; i++) {
                        html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                    }
                    $('#select_category').html(html_select);
                })
            }
            
        }

        function load_select_category(){
            var category_id = $('#select_category').val();
            var subcategory_id = $('#subcategory_id').val();
            mostrar_category(category_id,subcategory_id);
        }

        function mostrar_category(category_id,subcategory_id=null){
            //SI SELECCIONO OTRO ITEM LA ULTMIMA CATEGORIA SE BORRA
            if(!category_id ){
                    $('#select_subcategory').html('<option value="">Seleccione Subcategoría</option>');
                    return;
            }
            //ajax
            $.get('/admin/tickets/'+category_id+'/subcategories',function(data){
                var html_select = '<option value="">Seleccione Subcategoría</option>';
                for (let i = 0; i < data.length; i++) {
                    if (data[i].id == subcategory_id) {
                        html_select += '<option value="'+data[i].id+'" selected>'+data[i].name+'</option>';
                    }else{
                        html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                    }
                }
                $('#select_subcategory').html(html_select);
            })
            
        }
     </script> 
@stop