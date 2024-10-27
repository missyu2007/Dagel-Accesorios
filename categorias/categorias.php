<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../productos/estiloped.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Dagel - Categorias</title>
</head>
<body>




<?php
 include('../index/barra.php');
?> 
<a href="../paneles/admin_dashboard.php"><i class='bx bx-arrow-back' style="font-size: 48px; color: #4d6e18;"></i></i></i></a>
<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirigir al login si no hay sesión iniciada
    header('Location: login.php');
    exit;
}


echo '<div style="text-align: center; margin: 20px 0; font-size: 1.5rem; color: #272727;">Bienvenido a Categorías, ' . htmlspecialchars($_SESSION['usuario']) . '!</div>';

?>
<br>
<br>


<div class="main">
  <ul class="cards">
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="añade.jpg"></div>
        <div class="card_content">
          <h2 class="card_title">Añade una nueva Categoria</h2>
          <p class="card_text">Aquí podrás añadir una nueva categoría a tu inventario, lo que te permitirá mantener tus productos perfectamente organizados y facilitará la búsqueda y la administración de tu mercancía ,también optimizarás la gestión de tu negocio.</p>
          <a href="regis_cat.php" class="btn card_btn">Vea mas aqui!</a>  
        </div>
      </div>
    </li>
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="consulta.jpg"></div>
        <div class="card_content">
          <h2 class="card_title">Consulta , Actualiza y Elimina los registros de Categoria</h2>
          <p class="card_text">En esta seccion podras consultar las categorias actuales que tienes en tu inventario:</p>
          <a href="consul_cat.php" class="btn card_btn">Vea más aquí!</a>
        </div>
      </div>
    </li>
</div class="main">
    
    
</body>
</html>