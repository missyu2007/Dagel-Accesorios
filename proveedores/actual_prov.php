<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_proveedor = $_POST['id_proveedor'];  // Cambiado a $id_proveedor en lugar de $id_categoria
    $nombre_prov = $_POST['nombre_prov'];
    $contacto_prov = $_POST['contacto_prov'];
    $con_pago = $_POST['con_pago'];
    $productos_sum = $_POST['productos_sum'];
    $can_stock = $_POST['can_stock'];

    // Verificar que los campos obligatorios no estén vacíos
    if (!empty($id_proveedor) && !empty($nombre_prov) && !empty($contacto_prov)) {
        require_once('../conexion.php'); // Asegúrate de que la conexión a la base de datos esté correctamente configurada

        // Actualizar la tabla de proveedores
        $SQL = "UPDATE proveedores SET 
                    nombre_prov = :nombre_prov, 
                    contacto_prov = :contacto_prov, 
                    con_pago = :con_pago,
                    productos_sum = :productos_sum,
                    can_stock = :can_stock
                WHERE id_proveedor = :id_proveedor";
        
        $stmt = $conexion->prepare($SQL);
        $stmt->bindParam(':id_proveedor', $id_proveedor, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_prov', $nombre_prov, PDO::PARAM_STR);
        $stmt->bindParam(':contacto_prov', $contacto_prov, PDO::PARAM_STR);
        $stmt->bindParam(':con_pago', $con_pago, PDO::PARAM_STR);
        $stmt->bindParam(':productos_sum', $productos_sum, PDO::PARAM_STR);
        $stmt->bindParam(':can_stock', $can_stock, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Proveedor actualizado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el proveedor.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>
