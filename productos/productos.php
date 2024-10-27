<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estiloped.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Productos</title>
</head>
<body>
    
<?php
 include('../index/barra.php');
?> 

<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirigir al login si no hay sesión iniciada
    header('Location: login.php');
    exit;
}


// Mostrar el nombre del usuario
echo 'Bienvenido Administrador, ' . $_SESSION['usuario'] . '!';
?>
<br>
<br>
<a href="../paneles/admin_dashboard.php"><i class='bx bx-arrow-back' style="font-size: 48px; color: #4d6e18;"></i></i></i></a>

<div class="main">
  <ul class="cards">
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="registrar.jpg"></div>
        <div class="card_content">
          <h2 class="card_title">Nuevo Producto</h2>
          <p class="card_text">En esta seccion podras añadir un nuevo producto a tu inventario :</p>
          <a href="registrar.php" class="btn card_btn">Vea mas aqui!</a>  
        </div>
      </div>
    </li>
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="consul.png"></div>
        <div class="card_content">
          <h2 class="card_title">Consulta tus productos</h2>
          <p class="card_text">En esta seccion podras consultar los productos que tienes en tu inventario:</p>
          <a href="consultar.php" class="btn card_btn">Vea más aquí!</a>
        </div>
      </div>
    </li>
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="actualiza.png"></div>
        <div class="card_content">
          <h2 class="card_title">Actualiza tus productos</h2>
          <p class="card_text">En esta seccion podras actualizar los datos de cualquier de tus Productos :</p>
          <a href="actual_pro.php" class="btn card_btn">Vea mas aqui!</a>
        </div>
      </div>
    </li>
  </ul>
</div>
    
</body>
</html>