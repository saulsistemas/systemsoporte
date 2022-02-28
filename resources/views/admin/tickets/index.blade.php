@extends('adminlte::page')

@section('title', 'Tickets')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="card bg-light mb-3">
        <div class="card-header">
            <h3 class="card-title">LISTADO TICKETS</h3>
            <div class="card-tools">
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-tool">
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

            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                aria-selected="true">TICKETS CREADOS SIN ASIGNAR</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile"
                                aria-selected="false">TICKETS ASIGNADOS A MÍ SIN RESOLVER</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill"
                                href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages"
                                aria-selected="false">10 ÚLTIMOS TICKETS CONCLUIDOS</a>
                        </li>
                        
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                @if (session('estado'))
                                <div class="alert alert-{{ session('estado') }}">
                                    <strong>{{ session('texto') }}</strong>
                                </div>
                                @endif
                            <div class="d-md-flex justify-content-md-end">
                                <form action="{{ route('admin.tickets.index') }}" method="GET">
                                    <div class="btn-group">
                                        <input type="text" name="busqueda" class="form-control">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-search-plus"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                @can('admin.tickets.create')
                                    <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary"><i
                                            class="fas fa-plus-square"></i></a>
                                @endcan
                            </div>
                            <table class="table table-hover table-bordered">
                                <thead class="text-white bg-primary">
                                    <th>NRO</th>
                                    <th>FECHA</th>
                                    <th>EMPRESA</th>
                                    <th>SEVERIDAD</th>
                                    <th>CLIENTE</th>
                                    <th>CATEGORIZACIÓN</th>
                                    <th>TITULO</th>
                                    <th>ESTADO</th>
                                    <th>ASIGNADO A</th>
                                    <th>OPCIONES</th>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td><a class="btn btn-primary"
                                                    href="{{ route('admin.tickets.show', $ticket) }}">{{ $ticket->id }}</a></td>
                                            <td>{{ $ticket->start }}</td>
                                            <td>{{ $ticket->client->office->company->name }}</td>
                                            <td>{{ $ticket->setSeverity($ticket->severity) }}</td>
                                            <td>{{ $ticket->client->name }}</td>
                                            <td>
                                                {{ $ticket->subcategory->category->service->name }}<br>
                                                {{ $ticket->subcategory->category->name }}<br>
                                                {{ $ticket->subcategory->name }}
                                            </td>
                                            <td>{{ $ticket->setTitleShort($ticket->title) }}</td>
                                            <td>{{ $ticket->getIncident() }}</td>
                                            <td>{{ $ticket->getSupport() }}</td>
                                            <td class="btn-group">
                                                @can('admin.tickets.show')
                                                    <a class="btn btn-primary" href="{{ route('admin.tickets.show', $ticket) }}"><i
                                                            class="fas fa-list-alt"></i></a>
                                                @endcan
        
                                                @can('admin.tickets.edit')
                                                    <a class="btn btn-warning" href="{{ route('admin.tickets.edit', $ticket) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                @endcan
        
                                                @can('admin.tickets.destroy')
                                                    <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST"
                                                        class="formulario-eliminar">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="10"> {{ $tickets->appends(['busqueda' => $busqueda]) }} </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            <table class="table table-hover table-bordered">
                                <thead class="text-white bg-warning">
                                    <th>NRO</th>
                                    <th>FECHA</th>
                                    <th>EMPRESA</th>
                                    <th>SEVERIDAD</th>
                                    <th>CLIENTE</th>
                                    <th>CATEGORIZACIÓN</th>
                                    <th>TITULO</th>
                                    <th>ESTADO</th>
                                    <th>ASIGNADO A</th>
                                    <th>DETALLES</th>
                                </thead>
                                <tbody>
                                    @foreach ($my_tickets as $ticket)
                                        <tr>
                                            <td><a class="btn btn-primary"
                                                    href="{{ route('admin.tickets.show', $ticket) }}">{{ $ticket->id }}</a>
                                            </td>
                                            <td>{{ $ticket->start }}</td>
                                            <td>{{ $ticket->client->office->company->name }}</td>
                                            <td>{{ $ticket->setSeverity($ticket->severity) }}</td>
                                            <td>{{ $ticket->client->name }}</td>
                                            <td>
                                                {{ $ticket->subcategory->category->service->name }}<br>
                                                {{ $ticket->subcategory->category->name }}<br>
                                                {{ $ticket->subcategory->name }}
                                            </td>
                                            <td>{{ $ticket->setTitleShort($ticket->title) }}</td>
                                            <td>{{ $ticket->getIncident() }}</td>
                                            <td>{{ $ticket->getSupport() }}</td>
                                            <td>
                                                @can('admin.tickets.show')
                                                    <a class="btn btn-primary" href="{{ route('admin.tickets.show', $ticket) }}"><i
                                                            class="fas fa-list-alt"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table class="table table-hover table-bordered">
                                <thead class="text-white bg-success">
                                    <th>NRO</th>
                                    <th>FECHA</th>
                                    <th>EMPRESA</th>
                                    <th>SEVERIDAD</th>
                                    <th>CLIENTE</th>
                                    <th>CATEGORIZACIÓN</th>
                                    <th>TITULO</th>
                                    <th>ESTADO</th>
                                    <th>ASIGNADO A</th>
                                    <th>ABRIR</th>
                                </thead>
                                <tbody>
                                    @foreach ($solution_tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
                                            <td>{{ $ticket->start }}</td>
                                            <td>{{ $ticket->client->office->company->name }}</td>
                                            <td>{{ $ticket->setSeverity($ticket->severity) }}</td>
                                            <td>{{ $ticket->client->name }}</td>
                                            <td>
                                                {{ $ticket->subcategory->category->service->name }}<br>
                                                {{ $ticket->subcategory->category->name }}<br>
                                                {{ $ticket->subcategory->name }}
                                            </td>
                                            <td>{{ $ticket->setTitleShort($ticket->title) }}</td>
                                            <td>{{ $ticket->getIncident() }}</td>
                                            <td>{{ $ticket->getSupport() }}</td>
                                            <td>
                                                @can('admin.tickets.show')
                                                    <a class="btn btn-primary" href="{{ route('admin.tickets.abrir', $ticket) }}"><i
                                                            class="fas fa-lock-open"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
        
                            </table>
                        </div>
                        
                    </div>
                </div>

            </div>


            {{-- <div class="card">
                <div class="card-header text-white bg-primary">
                    TICKETS CREADOS SIN ASIGNAR
                </div>
                <div class="card-body">
                    
                </div>
            </div>
            <div class="card">
                <div class="card-header text-white bg-warning">
                    TICKETS ASIGNADOS A MÍ SIN RESOLVER
                </div>
                <div class="card-body">

                </div>
            </div>

            <div class="card">
                <div class="card-header text-white bg-success">
                    10 ÚLTIMOS TICKETS CONCLUIDOS
                </div>
                <div class="card-body">

                </div>
            </div> --}}

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('estado') == 'danger')
        <script>
            Swal.fire(
                '{{ session('titulo') }}!',
                '{{ session('texto') }}',
                'success'
            )
        </script>
    @endif
    <script>
        $('.formulario-eliminar').submit(function(e) {
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
