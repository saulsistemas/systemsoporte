<div class="form-group">
    <label for="name">Nombre</label>
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
    @error('name')
        <small class="text-danger">{{$message}}</small>
    @enderror
</div>
<h3>Lista de Permisos</h3>
@foreach ($permissions as $permission)
    <div>
        <label for="">
            {!! Form::checkbox("permissions[]", $permission->id, null, ['class'=>'mr-1']) !!}
            {{$permission->description}}
        </label>
    </div>
@endforeach