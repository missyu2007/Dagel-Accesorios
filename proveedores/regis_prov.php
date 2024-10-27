<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dagel - Proveedores</title>
  <link rel="stylesheet" href="../productos/estiloform.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php
include('../index/barra.php');
?>
<a href="../proveedores/proveedores.php"><i class='bx bx-arrow-back' style="font-size: 48px; color: #4d6e18;"></i></a>

<div class="container">
  <div class="container-sm" style="margin-top:1%">
    <form method="POST" action="">
      <p>Por favor, diligencie todos los campos de este formulario.</p>

      <div class="form-group">
        <label for="txtProveedor">Nombre del Proveedor</label>
        <input type="text" class="form-control" name="txtProveedor" placeholder="Ingrese nombre del proveedor" required>
      </div>

      <div class="form-group">
        <label for="txtProducto_suministrado">Producto Suministrado:</label>
        <input type="text" class="form-control" name="txtProducto_suministrado" placeholder="Ingrese el producto suministrado" required>
      </div>

      <div class="form-group">
        <label for="txtCondiciones_pago">Condiciones de Pago:</label>
        <select class="form-control" name="txtCondiciones_pago" required>
          <option value="">Seleccione las condiciones de pago</option>
          <option value="Transferencia">Transferencia</option>
          <option value="Efectivo">Efectivo</option>
          <option value="Pago contra Entrega">Pago contra Entrega</option>
        </select>
      </div>

      <div class="form-group">
        <label for="txtCantidad_producto">Cantidad de Stock:</label>
        <input type="number" class="form-control" name="txtCantidad_producto" placeholder="Ingrese cantidad de productos entregados" required>
      </div>

      <div class="form-group">
        <label for="txtContacto">Contacto:</label>
        <input type="text" class="form-control" name="txtContacto" placeholder="Ingrese el contacto" required>
      </div>

      <br>
      <input type="submit" class="btn btn-primary" value="Registrar proveedor">
    </form>

    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $prov = $_POST['txtProveedor'];
        $psum = $_POST['txtProducto_suministrado'];
        $cpag = $_POST['txtCondiciones_pago'];
        $cantp = $_POST['txtCantidad_producto'];
        $cont = $_POST['txtContacto'];

        require_once('../conexion.php');
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $sql = 'INSERT INTO proveedores (nombre_prov, productos_sum, con_pago, can_stock, contacto_prov) 
                    VALUES (:n, :p, :c, :d, :t)';
            
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":n", $prov);
            $stmt->bindParam(":p", $psum);
            $stmt->bindParam(":c", $cpag);
            $stmt->bindParam(":d", $cantp);
            $stmt->bindParam(":t", $cont);
            $stmt->execute();

            echo "<script>alert('Registro guardado con éxito');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Error al guardar el registro: " . $e->getMessage() . "');</script>";
        }
    }
    ?>
  </div>
</div>

<script src="/proyectoSENA/js/bootstrap.bundle.min.js"></script>
</body>
</html>
