<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dagel</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Dagel</a>
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
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-sm">
    <table class="table caption-top">
    <caption>Lista de productos</caption>
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre del Producto</th>
            <th scope="col">Categoría del Producto</th>
            <th scope="col">Precio del Producto</th>
            <th scope="col">Descripción del Producto</th>
            <th scope="col">Cantidad de Stock</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once('conexion.php');
        $SQL = 'SELECT id_productos, nombre_pro, categoria_pro, precio_pro, descripcion_pro, cantidad_stock FROM productos';
        $stmt = $conexion->prepare($SQL);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $row['id_productos']; ?></td>
                <td><?php echo $row['nombre_pro']; ?></td>
                <td><?php echo $row['categoria_pro']; ?></td>
                <td><?php echo $row['precio_pro']; ?></td>
                <td><?php echo $row['descripcion_pro']; ?></td>
                <td><?php echo $row['cantidad_stock']; ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    </table> 
</div>
</body>
</html>
