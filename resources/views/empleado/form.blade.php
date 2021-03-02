<h1>{{ $modo }} empleado</h1>
@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>  
    </div>
@endif
<div id="form-group">
    <label for="Nombre">Nombre:</label>
            <input class="form-control" type="text" value="{{ isset($empleado->Nombre)?$empleado->Nombre:old('Nombre') }}" name="Nombre" id="Nombre">
</div>
<div id="form-group">
        <label for="ApellidoPaterno">ApellidoPaterno:</label>
            <input class="form-control" type="text" value="{{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:old('ApellidoPaterno') }}" name="ApellidoPaterno" id="ApellidoPaterno">
</div>
<div id="form-group">
        <label for="ApellidoMaterno">ApellidoMaterno:</label>
            <input class="form-control" type="text" value="{{ isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:old('ApellidoMaterno') }}" name="ApellidoMaterno" id="ApellidoMaterno">
</div>
<div id="form-group">
        <label for="Correo">Correo:</label>
            <input class="form-control" type="text" value="{{ isset($empleado->Correo)?$empleado->Correo:old('Correo') }}" name="Correo" id="Correo">
</div>
<div id="form-group">
        <label for="Foto">Foto:</label>
        @if(isset($empleado->Foto))
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" width="100" height="100" alt="foto">
        @endif
            <input class="form-control" type="file" name="Foto" id="Foto">
</div>
<br><br>
<a href="{{ url('/empleado/') }}" class="btn btn-primary">Volver al inicio</a>
<input type="submit" value="{{ $modo }}" class="btn btn-success">