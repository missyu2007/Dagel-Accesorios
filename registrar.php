<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingresar Artículos</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
<nav class="navbar">
    <div class="navbar-logo">
        <a href="#">Dagel</a>
    </div>
    <ul class="navbar-menu">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="servicios.php">Servicios</a></li>
        <li><a href="nosotros.php">Nosotros</a></li> <!-- corregido de `nosotros-php` -->
        <li><a href="contacto.php">Contacto</a></li>
        <li><a href="login.php">Iniciar sesión</a></li> <!-- corregido de `seccion` a `sesión` -->
    </ul>
</nav>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
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

<div class="container">
  <div class="container-sm" style="margin-top:1%">
    <form method="POST" action="registrar.php">
      <p>Por favor, diligencie todos los campos de este formulario.</p>

      <div class="form-group">
        <label for="txtNombre">Nombre del Producto: </label>
        <input type="text" class="form-control" name="txtNombre" placeholder="Ingrese nombre del producto" required>
      </div>

      <div class="form-group">
        <label for="txtCategoria">Categoría del Producto:</label>
        <input type="text" class="form-control" name="txtCategoria" placeholder="Ingrese la categoría del producto" required>
      </div>

      <div class="form-group">
        <label for="txtPrecio">Precio del Producto:</label>
        <input type="number" class="form-control" name="txtPrecio" placeholder="Ingrese el precio del producto" required>
      </div>
     
      <div class="form-group">
        <label for="txtCantidad">Cantidad de Stock:</label>
        <input type="text" class="form-control" name="txtCantidad" placeholder="Ingrese el stock del producto" required>
      </div>

      <div class="form-group">
        <label for="txtDes">Descripción del Producto:</label>
        <input type="text" class="form-control" name="txtDes" placeholder="Ingrese la descripción del producto" required>
      </div>

      <br>
  
      <input type="submit" class="btn btn-primary" value="Registrar producto">
    </form>

    <?php 
    if ($_POST){
        $nom = $_POST['txtNombre'];
        $cate = $_POST['txtCategoria'];
        $prec = $_POST['txtPrecio'];
        $des = $_POST['txtDes'];
        $stoc = $_POST['txtCantidad'];

        require_once('conexion.php');
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL corregida
        $sql = 'INSERT INTO productos (nombre_pro, categoria_pro, precio_pro, cantidad_stock, descripcion_pro) 
                VALUES (:n, :c, :p, :s, :d)';
        
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":n", $nom);
        $stmt->bindParam(":c", $cate);
        $stmt->bindParam(":p", $prec);
        $stmt->bindParam(":s", $stoc);
        $stmt->bindParam(":d", $des);
        $stmt->execute();
        
        echo "<script>alert('Registro guardado con éxito');</script>";     
    }
    ?>
  </div>
</div>

<!-- Añadir scripts de Bootstrap si es necesario -->
<script src="/proyectoSENA/js/bootstrap.bundle.min.js"></script>
</body>
</html>
