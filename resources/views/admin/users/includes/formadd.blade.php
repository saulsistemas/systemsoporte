<div class="form-group">
    <label for="role_id">Rol</label>
    {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}
    @error('role_id')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    <label for="email">Email</label>
    {!! Form::email('email', null, ['class'=>'form-control','placeholder'=>'Ingrese dirección de correo']) !!}
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
    <label for="password">Contraseña  </label>
    {!! Form::password('password',  ['class'=>'form-control','placeholder'=>'Ingrese contraseña',]) !!}
    @error('password')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>