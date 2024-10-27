<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categorias</title>
  <link rel="stylesheet" href="../productos/estiloform.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php
include('../index/barra.php');
?>
<a href="../categorias/categorias.php"><i class='bx bx-arrow-back' style="font-size: 48px; color: #4d6e18;"></i></i></i></a>

<div class="container">
  <div class="container-sm" style="margin-top:1%">
    <form method="POST" action="regis_cat.php">
      <p>Por favor, diligencie todos los campos de este formulario.</p>

      <div class="form-group">
        <label for="txtNombre_cat">Nombre de la categoria: </label>
        <input type="text" class="form-control" name="txtNombre_cat" placeholder="Ingrese nombre de la categoria" required>
      </div>

      <div class="form-group">
        <label for="txtDescripcion_cat">Descripción de la categoria:</label>
        <input type="text" class="form-control" name="txtDescripcion_cat" placeholder="Ingrese la descripcion de la categoria" required>
      </div>
      <br>
  
      <input type="submit" class="btn btn-primary" value="Registrar Categoria">
    </form>

    <?php 
    if ($_POST){
        $nomC= $_POST['txtNombre_cat'];
        $desC= $_POST['txtDescripcion_cat'];
    
        require_once('..\conexion.php');
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL corregida
        $sql = 'INSERT INTO categoria (nombre_cat, Descripcion_cat) 
            VALUES (:n, :d)';
            
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":n", $nomC);
            $stmt->bindParam(":d", $desC);
            $stmt->execute();
    
        
        echo "<script>alert('Registro guardado con éxito');</script>";     
    }
    ?>
  </div>
</div>

<script src="/proyectoSENA/js/bootstrap.bundle.min.js"></script>
</body>
</html>