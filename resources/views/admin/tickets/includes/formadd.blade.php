<div class="form-group row">
    <label class="col-sm-2" for="service_id">Servicio :</label>
    <div class="col-sm-10">
        <select name="service_id" id="select_service" class="form-control" required>
            <option value="">Seleccione Servicio</option>
            @foreach ($services as $service)
                <option value="{{$service->id}}" >{{$service->name}}</option>
            @endforeach
        </select>
        @error('service_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="category_id">Categoría :</label>
    <div class="col-sm-10">
        <select name="category_id" id="select_category" class="form-control" required>
            <option value="">Seleccione Categoría</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="subcategory_id">Subcategoría :</label>
    <div class="col-sm-10">
        <select name="subcategory_id" id="select_subcategory" class="form-control" required>
            <option value="">Seleccione Subcategoría</option>
        </select>
        @error('subcategory_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="client_id">Cliente :</label>
    <div class="col-sm-10">
        <select name="client_id" id="client_class" class="form-control client_class">
            <option value="">Seleccione Cliente</option>
            @foreach ($users as $user)
                <option value="{{$user->id}}" {{old('client_id', 966) == $user->id ? 'selected' : ''}} >{{$user->name .' - '.$user->office->name.' - '.$user->office->company->name}}</option>
            @endforeach
        </select>
        @error('client_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="severity">Severidad :</label>
    <div class="col-sm-10">
    {!! Form::select('severity',$severity,null,['class'=>'form-control severt_class']) !!}
    @error('severity')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="contact_id">Tipo contacto :</label>
    <div class="col-sm-10">
    {!! Form::select('contact_id',$contacts,null,['class'=>'form-control severt_class']) !!}
    @error('contact_id')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="title">Título :</label>
    <div class="col-sm-10">
    {!! Form::text('title', null, ['class'=>'form-control','placeholder'=>'Ingrese título','onblur'=>'this.value=this.value.toUpperCase();','required'=>TRUE]) !!}
    @error('title')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="description">Descripción :</label>
    <div class="col-sm-10">
    {!! Form::textarea('description',null,['class'=>'form-control','placeholder'=>"Ingrese descripción",'rows'=> 2,'onblur'=>'this.value=this.value.toUpperCase();']) !!}
    @error('description')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2" for="start">Inicio :</label>
    <div class="col-sm-10">
    {!! Form::date('start', \Carbon\Carbon::now(),['class'=>'form-control','required'=>TRUE]) !!}
    @error('start')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
</div>
