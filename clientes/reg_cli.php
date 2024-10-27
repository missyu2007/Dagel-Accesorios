<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingresar Artículos</title>
  <link rel="stylesheet" href="../productos/estiloform.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>
<body>
<?php
include('../index/barra.php');
?>
<a href="../clientes/clientes.php"><i class='bx bx-arrow-back' style="font-size: 48px; color: #4d6e18;"></i></i></i></a>
<div class="container"> 

    <h2>Registrar Nuevo Cliente</h2> 
    <div class="container-sm" style="margin-top:1%">
        <form method="POST" action="">
            <p>Por favor, diligencie todos los campos de este formulario.</p>

            <div class="form-group">
                <label for="txtNombre">Nombre del Cliente:</label>
                <input type="text" class="form-control" name="txtNombre" placeholder="Ingrese nombre del Cliente" required>
            </div>

            <div class="form-group">
                <label for="txtApellidos">Apellidos del Cliente:</label>
                <input type="text" class="form-control" name="txtApellidos" placeholder="Ingrese el apellido del cliente" required>
            </div>
         
            <div class="form-group">
                <label for="txtDireccion">Dirección del cliente:</label>
                <input type="text" class="form-control" name="txtDireccion" placeholder="Ingrese la dirección del cliente" >
            </div>

            <div class="form-group">
               <label for="txtCorreo">Correo Electrónico:</label>
              <input type="email" class="form-control" name="txtCorreo" placeholder="Ingrese el correo del cliente" >
            </div>

            <div class="form-group">
              <label for="txtTel">Teléfono del Cliente:</label>
              <input type="number" class="form-control" name="txtTel" placeholder="Ingrese el teléfono del cliente" required>
            </div>
            <div class="form-group">
                <label for="txtHis">Historial del Cliente:</label>
                <select class="form-control" name="txtHis" required>
                    <option value="">Seleccione el Historial del cliente</option>
                    <option value="Primera Compra">Primera Compra</option>
                    <option value="Segunda Compra">Segunda Compra</option>
                    <option value="Cliente Preferencial">Cliente Preferencial</option>
                </select>
            </div>

            <input type="submit" class="btn btn-primary" value="Registrar cliente">
        </form>
    </div>
  </div>



<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura de datos del formulario
    $nom = $_POST['txtNombre'];
    $ape = $_POST['txtApellidos'];
    $dir = $_POST['txtDireccion'];
    $correo = $_POST['txtCorreo'];
    $tel = $_POST['txtTel'];
    $his = $_POST['txtHis'];

    require_once('../conexion.php');

    try {
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL
        $sql = 'INSERT INTO clientes (nombre_cli, apellido_cli, direccion_cli, correo_cli, telefono_cli, historial_cli) 
                VALUES (:n, :a, :d, :c, :t, :h)';
        
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":n", $nom);
        $stmt->bindParam(":a", $ape);
        $stmt->bindParam(":d", $dir);
        $stmt->bindParam(":c", $correo);
        $stmt->bindParam(":t", $tel);
        $stmt->bindParam(":h", $his);
        $stmt->execute();
        
        echo "<script>alert('Registro guardado con éxito');</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

</body>
</html>
