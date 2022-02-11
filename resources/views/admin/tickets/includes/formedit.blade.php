<div class="form-group">
    <label for="name">Nombre</label>
    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese nombre','onblur'=>'this.value=this.value.toUpperCase();']) !!}
    @error('name')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    <label for="description">Descripción</label>
    {!! Form::textarea('description',null,['class'=>'form-control','placeholder'=>"Ingrese descripción",'rows'=> 2,'onblur'=>'this.value=this.value.toUpperCase();']) !!}
    @error('description')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    <label for="start">Descripción</label>
    {!! Form::date('start', null,['class'=>'form-control'])!!}
    @error('start')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
