<?php
$servidor = 'localhost'; // Servidor Local.
$bd = 'dagel'; // Base de datos.
$user = 'root'; // Usuario de MySQL.
$pass = ''; // Contraseña de MySQL (Si no tienes clave, déjalo así).

try {
    // Cadena de conexión a la base de datos.
    $conexion = new PDO('mysql:host=' . $servidor . ';dbname=' . $bd, $user, $pass);
    
    // Configurar atributos de PDO
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}

// No es necesario usar return; $conexion estará disponible en el contexto que lo incluya.
?>
