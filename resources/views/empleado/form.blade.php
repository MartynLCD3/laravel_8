<h1>{{ $modo }} empleado</h1>
<label for="Nombre">Nombre:</label>
        <input type="text" value="{{ isset($empleado->Nombre)?$empleado->Nombre:'' }}" name="Nombre" id="Nombre">
    <label for="ApellidoPaterno">ApellidoPaterno:</label>
        <input type="text" value="{{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:'' }}" name="ApellidoPaterno" id="ApellidoPaterno">
    <label for="ApellidoMaterno">ApellidoMaterno:</label>
        <input type="text" value="{{ isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:'' }}" name="ApellidoMaterno" id="ApellidoMaterno">
    <label for="Correo">Correo:</label>
        <input type="text" value="{{ isset($empleado->Correo)?$empleado->Correo:'' }}" name="Correo" id="Correo">
    <label for="Foto">Foto:</label>
    @if(isset($empleado->Foto))
    <img src="{{ asset('storage').'/'.$empleado->Foto }}" alt="foto">
    @endif
        <input type="file" value="{{ isset($empleado->Foto)?$empleado->Foto:'' }}" name="Foto" id="Foto">
    <input type="submit" value="{{ $modo }}">
    <a href="{{ url('/empleado/') }}">Volver al inicio</a>