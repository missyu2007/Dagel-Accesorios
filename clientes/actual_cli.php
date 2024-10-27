<?php
require_once('../conexion.php'); // Asegúrate de que la conexión a la base de datos está correctamente incluida

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $nombre_cli = $_POST['nombre_cli'];
    $apellido_cli = $_POST['apellido_cli'];
    $direccion_cli = $_POST['direccion_cli'];
    $correo_cli = $_POST['correo_cli'];
    $telefono_cli = $_POST['telefono_cli'];
    $historial_cli = $_POST['historial_cli'];

    $SQL = 'UPDATE clientes SET nombre_cli = ?, apellido_cli = ?, direccion_cli = ?, correo_cli = ?, telefono_cli = ?, historial_cli = ? WHERE id_cliente = ?';
    $stmt = $conexion->prepare($SQL);

    try {
        $stmt->execute([$nombre_cli, $apellido_cli, $direccion_cli, $correo_cli, $telefono_cli, $historial_cli, $id_cliente]);
        echo json_encode(['success' => true, 'message' => 'Cliente actualizado correctamente.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el cliente: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>
