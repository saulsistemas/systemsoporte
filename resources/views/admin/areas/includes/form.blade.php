<div class="form-group">
    <label for="company_id">Empresa</label>
    {!! Form::select('company_id',$companies,null,['class'=>'form-control']) !!}
    @error('company_id')
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

