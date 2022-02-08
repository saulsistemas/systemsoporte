@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="card bg-light mb-3" >
    <div class="card-header">
        <h3 class="card-title">Listado Usuarios</h3>
        <div class="card-tools">
            <a href="{{ route('users.index') }}" class="btn btn-tool" >
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
            <form action="{{ route('users.index') }}" method="GET">
                <div class="btn-group">
                    <input type="text" name="busqueda" class="form-control">
                    <button type="submit" class="btn btn-primary" ><i class="fas fa-search-plus"></i></button>
                </div>
            </form>
        </div> 
        <div>
            @can('users.create')
                <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fas fa-plus-square"></i></a>
            @endcan
        </div> 
        <table class="table table-striped">
            <thead>
                <td>ID</td>
                <td>EMPRESA</td>
                <td>SEDE</td>
                <td>ROL</td>
                <td>CORREO</td>
                <td>NOMBRE</td>
                <td>APELLIDO</td>
                <td>ESTADO</td>
                <td>CREADO</td>
                <td>OPCIONES</td>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->office->company->name}}</td>
                        <td>{{$user->office->name}}</td>
                        <td>@if ($user->getRole()){{$user->getRole()->name}} @else @endif</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>@if(!$user->trashed())<p class="badge bg-success">ACTIVO</p> @else <p class="badge bg-danger">ELIMINADO</p> @endif</td>
                        <td>{{$user->created_at}}</td>
                        <td class="btn-group">
                            {{-- <a class="btn btn-primary" href="{{ route('users.show', $user) }}"><i class="fas fa-list-alt"></i></a> --}}
                            @can('users.edit')
                            @if ($user->trashed())
                            @else 
                                <a class="btn btn-warning" href="{{ route('users.edit', $user) }}"><i class="fas fa-edit"></i></a>
                            @endif
                            @endcan
                            @if ($user->trashed())
                                @can('users.restore')
                                <a class="btn btn-success" href="{{ route('users.restore', $user->id) }}"><i class="fas fa-redo-alt"></i></a>
                                @endcan 
                            @else 
                                @can('users.destroy')
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="formulario-eliminar">
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
                    <td colspan="4"> {{$users->appends(['busqueda'=>$busqueda])}} </td>
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