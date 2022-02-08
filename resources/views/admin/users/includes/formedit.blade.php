<div class="form-group">
    <label for="role_id">Rol</label>
    {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}
    @error('role_id')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    <label for="companies">Empresa/Sede</label>
    <select name="office_id" id="office_id" class="form-control">
        <option value="">Seleccione ..</option>
        @foreach ($companies as $company)
            @if ($company->id == $user->office_id)
                <option value="{{$company->id}}" selected>{{$company->empresa.' - '.$company->oficina}}</option>
            @else
                <option value="{{$company->id}}" >{{$company->empresa.' - '.$company->oficina}}</option>
            @endif
        @endforeach
    </select>
    @error('office_id')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <label for="email">Email</label>
    {!! Form::email('email', null, ['class'=>'form-control','placeholder'=>'Ingrese dirección de correo','readonly'=>TRUE]) !!}
    @error('email')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    <label for="name">Nombre</label>
    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese nombre','onblur'=>'this.value=this.value.toUpperCase();']) !!}
    @error('name')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    <label for="last_name">Apellido</label>
    {!! Form::text('last_name', null, ['class'=>'form-control','placeholder'=>'Ingrese Apellido','onblur'=>'this.value=this.value.toUpperCase();']) !!}
    @error('last_name')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    <label for="password">Contraseña <em>Ingresar solo si se deseas cambiar</em> </label>
    {!! Form::password('password',  ['class'=>'form-control','placeholder'=>'Ingrese contraseña',]) !!}
    @error('password')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>