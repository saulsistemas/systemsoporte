<div class="form-group">
    <label for="project_id">Proyectos</label>
    {!! Form::select('project_id',$projects,null,['class'=>'form-control']) !!}
    @error('project_id')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    <label for="user_id">Usuario Soporte</label>
    {!! Form::select('user_id',$users,null,['class'=>'form-control']) !!}
    @error('user_id')
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

