
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Formulario de Actualización</title>
</head>
<body>
    <h2>Actualización de Datos</h2>
    <!-- Botón de edición -->
<button onclick="editarProducto()">Editar</button>

<!-- Formulario oculto -->
<form id="form-edicion" style="display:none;">
  <label>Nombre:</label>
  <input type="text" id="nombre-producto" value="Nombre actual">
  <br>
  <label>Descripción:</label>
  <textarea id="descripcion-producto">Descripción actual</textarea>
  <br>
  <button onclick="actualizarProducto()">Guardar cambios</button>
</form>

<!-- Función JavaScript para editar producto -->
<script>
  function editarProducto() {
    document.getElementById("form-edicion").style.display = "block";
  }

  function actualizarProducto() {
    var nombre = document.getElementById("nombre-producto").value;
    var descripcion = document.getElementById("descripcion-producto").value;
    // Actualiza el nombre y descripción del producto en la base de datos o en la página
  }
</script>
</body>
</html>
