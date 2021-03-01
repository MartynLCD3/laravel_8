<label for="Nombre">Nombre:</label>
        <input type="text" value="{{ $empleado->Nombre }}" name="Nombre" id="Nombre">
    <label for="ApellidoPaterno">ApellidoPaterno:</label>
        <input type="text" value="{{ $empleado->ApellidoPaterno }}" name="ApellidoPaterno" id="ApellidoPaterno">
    <label for="ApellidoMaterno">ApellidoMaterno:</label>
        <input type="text" value="{{ $empleado->ApellidoMaterno }}" name="ApellidoMaterno" id="ApellidoMaterno">
    <label for="Correo">Correo:</label>
        <input type="text" value="{{ $empleado->Correo }}" name="Correo" id="Correo">
    <label for="Foto">Foto:</label>
    {{ $empleado->Foto }}
    <img src="{{ asset('storage').'/'.$empleado->Foto }}" alt="foto">
        <input type="file" value="{{ $empleado->Foto }}" name="Foto" id="Foto">
    <input type="submit" value="Enviar">