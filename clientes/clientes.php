<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilocli.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

   

    <title>Clientes</title>
</head>
<body>
    
<?php
include('../index/barra.php');
?>


<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}


echo 'Bienvenido Administrador, ' . $_SESSION['usuario'] . '!';
?>
<br>
<br>
<a href="../paneles/admin_dashboard.php"><i class='bx bx-arrow-back' style="font-size: 48px; color: #4d6e18;"></i></i></i></a>

<div class="main">
  <ul class="cards">
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="nuevocli.avif"></div>
        <div class="card_content">
          <h2 class="card_title">Nuevo Cliente</h2>
          <p class="card_text">En esta seccion podras añadir los datos de tus nuevos clientes : </p>
          <a href="reg_cli.php" class="btn card-btn">Vea mas aqui!</a>
        </div>
      </div>
    </li>
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="../productos/consul.png"></div>
        <div class="card_content">
          <h2 class="card_title">Consulta  y Elimina tus clientes </h2>
          <p class="card_text">En esta seccion podras consultar la informacion almacenada de tus clientes y eliminarla</p>
          <a href="consul_cli.php" class="btn card-btn">Vea mas aqui!</a>
        </div>
      </div>
    </li>
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="../productos/actualiza.png"></div>
        <div class="card_content">
          <h2 class="card_title">Actualiza tus Clientes</h2>
          <p class="card_text">En esta seccion podras actualizar los datos almacenados de tus clientes :</p>
          <a href="actual_cli.php" class="btn card-btn">Vea mas aqui!</a>
        </div>
      </div>
    </li>
  </ul>
</div>

<h3 class="made_by">Made with ♡</h3>
    
</body>
</html>