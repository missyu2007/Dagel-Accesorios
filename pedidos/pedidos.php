<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../productos/estiloped.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Pedidos</title>
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
echo 'Bienvenido a Pedidos, ' . $_SESSION['usuario'] . '!';
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
          <h2 class="card_title">Nuevo Pedido</h2>
          <p class="card_text">En esta seccion podras añadir un nuevos pedidos a tu inventario :</p>
          <a href="regis_ped.php" class="btn card_btn">Vea mas aqui!</a>  
        </div>
      </div>
    </li>
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="consul.png"></div>
        <div class="card_content">
          <h2 class="card_title">Consulta tus pedidos</h2>
          <p class="card_text">En esta seccion podras consultar los pedidos que tienes para realizar:</p>
          <a href="consul_ped.php" class="btn card_btn">Vea más aquí!</a>
        </div>
      </div>
    </li>
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="actualiza.png"></div>
        <div class="card_content">
          <h2 class="card_title">Actualiza tus pedidos</h2>
          <p class="card_text">En esta seccion podras actualizar los datos de cualquier de tus pedidos :</p>
          <a href="actual_ped.php" class="btn card_btn">Vea mas aqui!</a>
        </div>
      </div>
    </li>
  </ul>
</div>
    
</body>
</html>