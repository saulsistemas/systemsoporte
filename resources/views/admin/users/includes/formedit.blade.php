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
    <label class="col-sm-2" for="company_id">Empresa</label>
    <div class="col-sm-10">
        {!! Form::select('company_id',$companies,null,['class'=>'form-control','id'=>'select_company']) !!}
        @error('company_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="office_id">Sede :</label>
    <div class="col-sm-10">
        <input type="hidden" id="office_id" value="{{$user->office_id}}">
        <select name="office_id" id="select_office" class="form-control" required>
            <option value="">Seleccione sede</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="area_id">Área :</label>
    <div class="col-sm-10">
        <input type="hidden" id="area_id" value="{{$user->area_id}}">
        <select name="area_id" id="select_area" class="form-control" required>
            <option value="">Seleccione área</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="email">Email</label>
    <div class="col-sm-10">
        {!! Form::email('email', null, ['class'=>'form-control','placeholder'=>'Ingrese dirección de correo','readonly'=>TRUE]) !!}
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
        {!! Form::text('phone', null, ['class'=>'form-control','placeholder'=>'Ingrese número','onblur'=>'this.value=this.value.toUpperCase();']) !!}
        @error('phone')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="password">Contraseña <em>Ingresar solo si se deseas cambiar</em> </label>
    <div class="col-sm-10">
        {!! Form::password('password',  ['class'=>'form-control','placeholder'=>'Ingrese contraseña',]) !!}
        @error('password')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="status">Estado</label>
    <div class="col-sm-10">
        {!! Form::select('status',$status,null,['class'=>'form-control']) !!}
        @error('status')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>