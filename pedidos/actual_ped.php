<?php
require_once('../conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pedidoId = $_POST['pedidoId'];
    $productos = $_POST['txtProductos'];
    $cantidades = $_POST['cantidades'];
    $estadoPedido = $_POST['txtEstadoPedido'];
    $metodoPago = $_POST['txtMetodo'];
    $total = $_POST['txtTotal'];

    try {
        // Actualizar el estado, método de pago y total del pedido
        $sqlUpdatePedido = "UPDATE pedidos SET estado_ped = :estado, metodo_pago = :metodo, total_ped = :total WHERE id_pedidos = :id";
        $stmtUpdatePedido = $conexion->prepare($sqlUpdatePedido);
        $stmtUpdatePedido->execute([
            ':estado' => $estadoPedido,
            ':metodo' => $metodoPago,
            ':total' => $total,
            ':id' => $pedidoId
        ]);

        // Eliminar los productos anteriores del pedido
        $sqlDeleteDetalle = "DELETE FROM detalle_pedido WHERE id_pedido = :id";
        $stmtDeleteDetalle = $conexion->prepare($sqlDeleteDetalle);
        $stmtDeleteDetalle->execute([':id' => $pedidoId]);

        // Insertar los nuevos productos y cantidades
        $sqlInsertDetalle = "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad) VALUES (:id_pedido, :id_producto, :cantidad)";
        $stmtInsertDetalle = $conexion->prepare($sqlInsertDetalle);

        for ($i = 0; $i < count($productos); $i++) {
            $stmtInsertDetalle->execute([
                ':id_pedido' => $pedidoId,
                ':id_producto' => $productos[$i],
                ':cantidad' => $cantidades[$i]
            ]);
        }

        header('Location: pedidos.php?status=success');
        exit();
    } catch (PDOException $e) {
        header('Location: pedidos.php?status=error');
        exit();
    }
}
?>
