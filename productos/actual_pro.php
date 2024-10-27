<?php
require_once('../conexion.php');

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id_productos = $_POST['id_productos'];
    $nombre_pro = $_POST['nombre_pro'];
    $descripcion_pro = $_POST['descripcion_pro'];
    $precio_pro = $_POST['precio_pro'];
    $cantidad_stock = $_POST['cantidad_stock'];
    $categoria_pro = $_POST['categoria_pro'];
    $modulo = $_POST['modulo'];
    $stand = $_POST['stand'];
    $cara = $_POST['cara'];
    $entre_paño = $_POST['entre_paño'];

    // Preparar la consulta de actualización
    $sql = "UPDATE productos SET 
                nombre_pro = :nombre_pro,
                descripcion_pro = :descripcion_pro,
                precio_pro = :precio_pro,
                cantidad_stock = :cantidad_stock,
                categoria_pro = :categoria_pro,
                modulo = :modulo,
                stand = :stand,
                cara = :cara,
                entre_paño = :entre_paño
            WHERE id_productos = :id_productos";

    try {
        $stmt = $conexion->prepare($sql);
        
        // Vincular parámetros
        $stmt->bindParam(':nombre_pro', $nombre_pro);
        $stmt->bindParam(':descripcion_pro', $descripcion_pro);
        $stmt->bindParam(':precio_pro', $precio_pro);
        $stmt->bindParam(':cantidad_stock', $cantidad_stock);
        $stmt->bindParam(':categoria_pro', $categoria_pro);
        $stmt->bindParam(':modulo', $modulo);
        $stmt->bindParam(':stand', $stand);
        $stmt->bindParam(':cara', $cara);
        $stmt->bindParam(':entre_paño', $entre_paño);
        $stmt->bindParam(':id_productos', $id_productos); 

        // Ejecutar la consulta
        if ($stmt->execute()) {
            header('Location: productos.php?status=success');
            exit();
        } else {
            header('Location: productos.php?status=error');
            exit();
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
