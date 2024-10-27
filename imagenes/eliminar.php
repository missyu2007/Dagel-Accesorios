<DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PROYECTO DAGEL</title>
  <link rel= "stylesheet" href="estilos.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">PROYECTO DAGEL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="registrar.php">Registrar <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="consultar.php">Consultar <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="eliminar.php">Eliminar <span class="sr-only">(current)</span></a></a>
        </li>
 <li class="nav-item">
          <a class="nav-link" href="actualizar.php">Actualizar <span class="sr-only">(current)</span></a>
      </ul>
    </div>
  </div>
</nav>

<div class="container-sm" style="margin-top:1%">
    <div class="alert alert-danger" role="alert">
        <b>Aviso:</b> El producto sera eliminado permanentemente
    </div>
    <form action="eliminar.php" method="POST">
        <div class="form-group">
        </div>
        <div class="form-group">
            <label for="txtID">Ingrese el ID del producto</label>
            <input type="text" class="form-control" name="txtID" placeholder="ID" required>
    </div>
    <input type="submit" class="btn btn-danger" value="Eliminar">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['txtID'];

    try {
        require_once('conexion.php');
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $SQL = 'DELETE FROM productos WHERE id_productos = :id';
        $stmt = $conexion->prepare($SQL);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        echo "<script>alert('Registro eliminado con éxito');</script>";
    } catch (PDOException $e) {

      
        echo "Error: " . $e->getMessage();
    }
}
?>
</div>