@extends('adminlte::page')

@section('title', 'Niveles')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="card bg-light mb-3" >
    <div class="card-header">
        <h3 class="card-title">Listado Niveles</h3>
        <div class="card-tools">
            <a href="{{ route('admin.levels.index') }}" class="btn btn-tool" >
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
            <form action="{{ route('admin.levels.index') }}" method="GET">
                <div class="btn-group">
                    <input type="text" name="busqueda" class="form-control">
                    <button type="submit" class="btn btn-primary" ><i class="fas fa-search-plus"></i></button>
                </div>
            </form>
        </div> 
        <div>
            @can('admin.levels.create')
                <a href="{{ route('admin.levels.create') }}" class="btn btn-primary"><i class="fas fa-plus-square"></i></a>
            @endcan
        </div> 
        <table class="table table-striped">
            <thead>
                <td>ID</td>
                <td>USUARIO</td>
                <td>PROYECTO</td>
                <td>NOMBRE</td>
                <td>CREADO</td>
                <td>OPCIONES</td>
            </thead>
            <tbody>
                @foreach ($levels as $level)
                    <tr>
                        <td>{{$level->id}}</td>
                        <td>{{$level->user->name.' '.$level->user->last_name}}</td>
                        <td>{{$level->project->name}}</td>
                        <td>{{$level->name}}</td>
                        <td>{{$level->created_at}}</td>
                        <td class="btn-group">
                            {{-- <a class="btn btn-primary" href="{{ route('admin.levels.show', $level) }}"><i class="fas fa-list-alt"></i></a> --}}
                            @can('admin.levels.edit')
                                <a class="btn btn-warning" href="{{ route('admin.levels.edit', $level) }}"><i class="fas fa-edit"></i></a>
                            @endcan
                            @can('admin.levels.destroy')
                                <form action="{{ route('admin.levels.destroy', $level) }}" method="POST" class="formulario-eliminar">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                                </form>
                            @endcan 
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"> {{$levels->appends(['busqueda'=>$busqueda])}} </td>
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
        title: 'Est??s seguro?',
        text: "El registro se eliminar?? definitivamente!",
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