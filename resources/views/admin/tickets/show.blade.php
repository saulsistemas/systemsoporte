@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="card bg-light mb-3" >
    <div class="card-header">
        DETALLE TICKET
    </div>
    <div class="card-body">
        <div class="card-body">
            @if (session('estado'))
            <div class="alert alert-{{session('estado')}}">
                <strong>{{session('titulo')}}</strong>
                <strong>{{session('texto')}}</strong>
            </div>
            @endif
            <p class="card-text">
                <table class="table table-hover table-bordered">
                    <thead>
                        <th>CÓDIGO</th>
                        <th>EMPRESA</th>
                        <th>SERVICIO/CATEGORIA/SUBCATEGORIA</th>
                        <th>FECHA CREADO</th>
                    </thead>
                    <tbody id="" >
                          <tr>
                              <td>{{$ticket->id}}</td>
                              <td>{{$ticket->client->office->company->name}}</td>
                              <td>{{$ticket->subcategory->category->service->name.' / '.$ticket->subcategory->category->name.' / '.$ticket->subcategory->name}}</td>
                              <td>{{$ticket->start}}</td>
                          </tr>
                    </tbody>
                    <thead>
                      <th>ASIGNADO A</th>
                      <th>NIVEL </th>
                      <th>ESTADO</th>
                      <th>SEVERIDAD</th>
                  </thead>
                  <tbody id="" >
                      <tr>
                          <td>{{$ticket->getSupport() }}</td>
                          <td>{{$ticket->level->name }}</td>
                          <td>{{$ticket->getIncident()}}</td>
                          <td>{{$ticket->setSeverity($ticket->severity)}}</td>
                      </tr>
                </tbody>
                </table>
                <br>
                <table class="table table-bordered">
                    <tr>
                        <th>TÍTULO</th>
                        <td>{{$ticket->title}}</td>
                    </tr>
                    <tr>
                        <th>DESCRIPCIÓN</th>
                        <td>{{$ticket->description}}</td>
                    </tr>
                    <tr>
                        @if ($ticket->support)
                            <th>SOLUCIÓN</th>
                            <td>
                                    {!! Form::model($ticket,['route'=>['admin.tickets.resolver',$ticket], 'autocomplete'=>'off','method'=>'put']) !!}
                                        {!! Form::textarea('solution',null,['class'=>'form-control','placeholder'=>"Ingrese descripción",'rows'=> 4,'onblur'=>'this.value=this.value.toUpperCase();']) !!}
                                        @error('solution')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <br>
                                        {!! Form::submit('Finalizar incidencia', ['class'=>'btn btn-success btn-sm']) !!}
                                    {!! Form::close() !!}
                                
                            </td>
                        @else
                        @endif
                    </tr>
                </table>
                <hr>
                    @if ($ticket->support)
                    @else
                        <a href="{{ route('admin.tickets.atender', $ticket) }}" class="btn btn-primary btn-sm">Atender incidencia</a>
                    @endif
                    @can('admin.tickets.edit')
                        <a class="btn btn-warning btn-sm" href="{{ route('admin.tickets.edit', $ticket) }}">Editar Incidencia</a>
                    @endcan
                    @if ($ticket->support)
                    <a href="{{ route('admin.tickets.derivar', $ticket) }}" class="btn btn-danger btn-sm">Derivar al siguiente nivel</a>
                    @else
                    @endif
              </p>
          </div>
           
    </div>
</div>
@stop
@section('js')
@stop