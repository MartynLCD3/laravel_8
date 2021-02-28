<form method="post" action="{{ url("/empleado") }}" enctype="multipart/form-data">
@csrf
    <label for="Nombre">Nombre:</label>
        <input type="text" name="Nombre" id="Nombre">
    <label for="ApellidoPaterno">ApellidoPaterno:</label>
        <input type="text" name="ApellidoPaterno" id="ApellidoPaterno">
    <label for="ApellidoMaterno">ApellidoMaterno:</label>
        <input type="text" name="ApellidoMaterno" id="ApellidoMaterno">
    <label for="Correo">Correo:</label>
        <input type="text" name="Correo" id="Correo">
    <label for="Foto">Foto:</label>
        <input type="file" name="Foto" id="Foto">
    <input type="submit" value="Enviar">
</form>