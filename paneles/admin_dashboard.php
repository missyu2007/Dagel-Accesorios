<?php
// Iniciar sesión
session_start();


session_regenerate_id(true);


if (!isset($_SESSION['usuario'])) {
    
    header('Location: ../index/index.php');
    exit;
}

// Manejo de cierre de sesión
if (isset($_POST['logout'])) {
    session_destroy(); // Destruir la sesión
    header('Location: ../index/index.php'); // Redirigir al login
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estiloadm.css">
    <title>Admin Dashboard</title>
</head>
<body>
<header>
    <?php include('../index/barra.php'); ?>
</header>

<div class="main">
    <!-- Mostrar el nombre del usuario debajo de la barra -->
    <p class="welcome-message"></p>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>! Podrás realizar las siguientes acciones:</h1>
    <!-- Botón de cierre de sesión -->
    
    
    
    <ul class="cards">
        <li class="cards_item">
            <div class="card">
                <div class="card_image"><img src="productos1.webp" alt="Imagen de productos"></div>
                <div class="card_content">
                    <h2 class="card_title">Productos</h2>
                    <p class="card_text">En esta sección podrás realizar varias acciones con respecto a los productos:</p>
                    <a href="../productos/productos.php" class="btn card_btn">¡Ve más aquí!</a>  
                </div>
            </div>
        </li>
        <li class="cards_item">
            <div class="card">
                <div class="card_image"><img src="categorias.png" alt="Imagen de categorías"></div>
                <div class="card_content">
                    <h2 class="card_title">Categorías</h2>
                    <p class="card_text">En esta sección podrás encontrar las categorías de tus productos:</p>
                    <a href="../categorias/categorias.php" class="btn card_btn">¡Ve más aquí!</a>
                </div>
            </div>
        </li>
        <li class="cards_item">
            <div class="card">
                <div class="card_image"><img src="clientes.png" alt="Imagen de clientes"></div>
                <div class="card_content">
                    <h2 class="card_title">Clientes</h2>
                    <p class="card_text">Encontrarás más detalles registrados acerca de tus clientes actuales aquí:</p>
                    <a href="../clientes/clientes.php" class="btn card_btn">¡Ve más aquí!</a>
                </div>
            </div>
        </li>
        <li class="cards_item">
            <div class="card">
                <div class="card_image"><img src="pedidos.jpg" alt="Imagen de pedidos"></div>
                <div class="card_content">
                    <h2 class="card_title">Pedidos</h2>
                    <p class="card_text">Encuentra más detalles sobre los pedidos actuales de forma detallada:</p>
                    <a href="../pedidos/pedidos.php" class="btn card_btn">¡Ve más aquí!</a>
                </div>
            </div>
        </li>
        <li class="cards_item">
            <div class="card">
                <div class="card_image"><img src="proveedores.jpg" alt="Imagen de proveedores"></div>
                <div class="card_content">
                    <h2 class="card_title">Proveedores</h2>
                    <p class="card_text">Encontrarás más información detallada sobre tus proveedores actuales:</p>
                    <a href="../proveedores/proveedores.php" class="btn card_btn">¡Ve más aquí!</a>
                </div>
            </div>
        </li>
    </ul>
</div>

<br>
<br>

<form method="post" style="margin-bottom: 20px;">
        <button type="submit" name="logout" class="btn btn-danger">Cerrar Sesión</button>
    </form>


<script src="../index/script.js"></script>
</body>
</html>
