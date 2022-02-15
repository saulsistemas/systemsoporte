@extends('adminlte::page')

@section('title', 'Áreas')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="card bg-light mb-3" >
    <div class="card-header">
        <h3 class="card-title">Listado Áreas</h3>
        <div class="card-tools">
            <a href="{{ route('admin.areas.index') }}" class="btn btn-tool" >
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
        @if (session('estado'))
            <div class="alert alert-{{session('estado')}}">
                <strong>{{session('texto')}}</strong>
            </div>
        @endif
        <div class="d-md-flex justify-content-md-end">
            <form action="{{ route('admin.areas.index') }}" method="GET">
                <div class="btn-group">
                    <input type="text" name="busqueda" class="form-control">
                    <button type="submit" class="btn btn-primary" ><i class="fas fa-search-plus"></i></button>
                </div>
            </form>
        </div> 
        <div>
            @can('admin.areas.create')
                <a href="{{ route('admin.areas.create') }}" class="btn btn-primary"><i class="fas fa-plus-square"></i></a>
            @endcan
        </div> 
        <table class="table table-striped">
            <thead>
                <td>ID</td>
                <td>EMPRESA</td>
                <td>NOMBRE</td>
                <td>REGISTRO</td>
                <td>CREADO</td>
                <td>OPCIONES</td>
            </thead>
            <tbody>
                @foreach ($areas as $area)
                    <tr>
                        <td>{{$area->id}}</td>
                        <td>{{$area->company->name}}</td>
                        <td>{{$area->name}}</td>
                        <td>@if(!$area->trashed())<p class="badge bg-success">REGITRADO</p> @else <p class="badge bg-danger">ELIMINADO</p> @endif</td>
                        <td>{{$area->created_at}}</td>
                        <td class="btn-group">
                            {{-- <a class="btn btn-primary" href="{{ route('admin.areas.show', $area) }}"><i class="fas fa-list-alt"></i></a> --}}
                            @can('admin.areas.edit')
                            @if ($area->trashed())
                            @else 
                                <a class="btn btn-warning" href="{{ route('admin.areas.edit', $area) }}"><i class="fas fa-edit"></i></a>
                            @endif
                            @endcan
                            @if ($area->trashed())
                                @can('admin.areas.restore')
                                <a class="btn btn-success" href="{{ route('admin.areas.restore', $area->id) }}"><i class="fas fa-redo-alt"></i></a>
                                @endcan 
                            @else 
                                @can('admin.areas.destroy')
                                <form action="{{ route('admin.areas.destroy', $area) }}" method="POST" class="formulario-eliminar">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                                </form>
                                @endcan 
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"> {{$areas->appends(['busqueda'=>$busqueda])}} </td>
                </tr>
            </tfoot>        
        </table>               
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('estado')=='danger')
        <script>
            Swal.fire(
                '{{session("titulo")}}!',
                '{{session("texto")}}',
                'success'
            )
        </script>
    @endif
<script>
    $('.formulario-eliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: 'Estás seguro?',
        text: "El registro se eliminará definitivamente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!',
        cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })        

    })
    
</script> 
@stop