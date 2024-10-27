<?php
try {
    require_once('../conexion.php');
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos: ' . $e->getMessage()]);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_categoria = $_POST['id_categoria'];
    $nombre_cat = $_POST['nombre_cat'];
    $Descripcion_cat = $_POST['Descripcion_cat'];

    if (!empty($id_categoria) && !empty($nombre_cat) && !empty($Descripcion_cat)) {
        require_once('../conexion.php'); // Asegúrate de que la conexión a la base de datos esté correctamente configurada

        $SQL = "UPDATE categoria SET nombre_cat = :nombre_cat, Descripcion_cat = :Descripcion_cat WHERE id_categoria = :id_categoria";
        $stmt = $conexion->prepare($SQL);
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_cat', $nombre_cat, PDO::PARAM_STR);
        $stmt->bindParam(':Descripcion_cat', $Descripcion_cat, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Categoría actualizada correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la categoría.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>
