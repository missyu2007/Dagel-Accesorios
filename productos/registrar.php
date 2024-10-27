<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuevo Producto</title>
  <link rel="stylesheet" href="estiloform.css"> 
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    .flex-row {
      display: flex;
      justify-content: space-between;
      gap: 2px; /* Espacio entre los elementos */
    }
  </style>
</head>
<body>
     
<?php
include('../index/barra.php');
require_once('../conexion.php'); // Asegúrate de incluir tu conexión

// Obtener categorías
$sqlCategorias = "SELECT id_categoria, nombre_cat FROM categoria";
$resultCategorias = $conexion->query($sqlCategorias);
?>

<a href="../productos/productos.php"><i class='bx bx-arrow-back' style="font-size: 48px; color: #4d6e18;"></i></a>

<div class="container"> 
    <h2>Registrar Nuevo Producto</h2> 
    <div class="container-sm" style="margin-top:1%">
        <form method="POST" action="registrar.php">
            <p>Por favor, diligencie todos los campos de este formulario.</p>

            <div class="form-group">
                <label for="txtNombre">Nombre</label>
                <input type="text" class="form-control" name="txtNombre" placeholder="Ingrese nombre del producto" required>
            </div>

            <div class="form-group">
                <label for="txtDes">Descripción</label>
                <input type="text" class="form-control" name="txtDes" placeholder="Ingrese la descripción del producto" required>
            </div>
            
            <div class="form-group">
                <label for="txtCategoria">Categoría</label>
                <select class="form-control" name="txtCategoria" required>
                    <option value="">Seleccione una categoría</option>
                    <?php while ($row = $resultCategorias->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo htmlspecialchars($row['id_categoria']); ?>">
                            <?php echo htmlspecialchars($row['nombre_cat']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="ubi">
            <h3>Ubicacion</h2>
            <div class="form-group flex-row">
                <div class="flex-item">
                    <label for="txtUbiModulo">Módulo</label>
                    <input type="number" class="form-control" name="txtUbiModulo" placeholder="Ingrese el módulo" required>
                </div>
                <div class="flex-item">
                    <label for="txtUbiStand">Stand</label>
                    <input type="number" class="form-control" name="txtUbiStand" placeholder="Ingrese el stand" required>
                </div>
            </div>

            <div class="form-group flex-row">
                <div class="flex-item">
                    <label for="txtUbiCara">Cara</label>
                    <input type="number" class="form-control" name="txtUbiCara" placeholder="Ingrese la cara" required>
                </div>
                <div class="flex-item">
                    <label for="txtUbiEntrePano">Entrepaño</label>
                    <input type="number" class="form-control" name="txtUbiEntrePano" placeholder="Ingrese el entre paño" required>
                </div>
            </div>
            </div>

            <div class="form-group">
                <label for="txtPrecio">Precio</label>
                <input type="number" class="form-control" name="txtPrecio" placeholder="Ingrese el precio del producto" required>
            </div>

            <div class="form-group">
                <label for="txtCantidad">Cantidad en Stock</label>
                <input type="text" class="form-control" name="txtCantidad" placeholder="Ingrese el stock del producto" required>
            </div>

            <input type="submit" class="btn btn-primary" value="Registrar producto">
        </form>
    </div>
</div>

<?php 
if ($_POST) {
    $nom = $_POST['txtNombre'];
    $des = $_POST['txtDes'];
    $precio = $_POST['txtPrecio'];
    $stock = $_POST['txtCantidad'];
    $categoria = $_POST['txtCategoria'];
    $modulo = $_POST['txtUbiModulo'];
    $stand = $_POST['txtUbiStand'];
    $cara = $_POST['txtUbiCara'];
    $entrePano = $_POST['txtUbiEntrePano'];

    try {
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = 'INSERT INTO productos (nombre_pro, descripcion_pro, precio_pro, cantidad_stock, categoria_pro, modulo, stand, cara, entre_paño) VALUES  
                (:n, :d, :p, :s, :c, :m, :st, :ca, :ep)'; 
        
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":n", $nom);
        $stmt->bindParam(":d", $des);
        $stmt->bindParam(":p", $precio);
        $stmt->bindParam(":s", $stock);
        $stmt->bindParam(":c", $categoria); 
        $stmt->bindParam(":m", $modulo);
        $stmt->bindParam(":st", $stand);
        $stmt->bindParam(":ca", $cara);
        $stmt->bindParam(":ep", $entrePano);

        $stmt->execute();

        echo "<script>alert('Registro guardado con éxito');</script>";     
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
</body>
</html>  
