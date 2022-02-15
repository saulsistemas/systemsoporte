<div class="form-group row">
    <label class="col-sm-2" for="role_id">Rol</label>
    <div class="col-sm-10">
        {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}
        @error('role_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="companies">Empresa/Sede</label>
    <div class="col-sm-10">
        <select name="office_id" id="office_id" class="form-control">
            <option value="">Seleccione ..</option>
            @foreach ($companies as $company)
                <option value="{{$company->id}}">{{$company->empresa.' - '.$company->oficina}}</option>
            @endforeach
        </select>
        @error('office_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="email">Email</label>
    <div class="col-sm-10">
        {!! Form::email('email', null, ['class'=>'form-control','placeholder'=>'Ingrese dirección de correo']) !!}
        @error('email')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="name">Código</label>
    <div class="col-sm-10">
        {!! Form::text('code', null, ['class'=>'form-control','placeholder'=>'Ingrese código','onblur'=>'this.value=this.value.toUpperCase();']) !!}
        @error('code')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="name">Nombre</label>
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese nombre','onblur'=>'this.value=this.value.toUpperCase();']) !!}
        @error('name')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="last_name">Apellido</label>
    <div class="col-sm-10">
        {!! Form::text('last_name', null, ['class'=>'form-control','placeholder'=>'Ingrese Apellido','onblur'=>'this.value=this.value.toUpperCase();']) !!}
        @error('last_name')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="area_id">Área</label>
    <div class="col-sm-10">
        {!! Form::select('area_id',$areas,null,['class'=>'form-control']) !!}
        @error('area_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="position">Puesto</label>
    <div class="col-sm-10">
        {!! Form::text('position', null, ['class'=>'form-control','placeholder'=>'Ingrese puesto de trabajo','onblur'=>'this.value=this.value.toUpperCase();']) !!}
        @error('position')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="phone">Celular</label>
    <div class="col-sm-10">
        {!! Form::text('phone', null, ['class'=>'form-control','placeholder'=>'Ingrese nombre','onblur'=>'this.value=this.value.toUpperCase();']) !!}
        @error('phone')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="password">Contraseña  </label>
    <div class="col-sm-10">
        {!! Form::password('password',  ['class'=>'form-control','placeholder'=>'Ingrese contraseña',]) !!}
        @error('password')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>