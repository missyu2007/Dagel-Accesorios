<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Pedido</title>
    <link rel="stylesheet" href="../productos/estiloform.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php
include('../index/barra.php');
require_once('../conexion.php');

// Obtener clientes
$sqlClientes = "SELECT id_cliente, nombre_cli FROM clientes";
$resultClientes = $conexion->query($sqlClientes);

// Obtener productos
$sqlProductos = "SELECT id_productos, nombre_pro, precio_pro FROM productos";
$resultProductos = $conexion->query($sqlProductos);
?>

<a href="../pedidos/pedidos.php"><i class='bx bx-arrow-back' style="font-size: 48px; color: #4d6e18;"></i></a>

<div class="container">
    <h2>Registrar Nuevo Pedido</h2>
    <div class="container-sm" style="margin-top:1%">
        <form method="POST" action="">
            <p>Por favor, diligencie todos los campos de este formulario.</p>

            <div class="form-group">
                <label for="txtFecha">Fecha del Pedido</label>
                <input type="date" class="form-control" name="txtFecha" required>
            </div>

            <label for="txtCliente">Cliente</label>
            <select class="form-control" name="txtCliente" required>
                <option value="">Seleccione un cliente</option>
                <?php while ($row = $resultClientes->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?php echo htmlspecialchars($row['id_cliente']); ?>"><?php echo htmlspecialchars($row['nombre_cli']); ?></option>
                <?php endwhile; ?>
            </select>

            <div class="form-group">
                <label for="txtProductos">Productos</label>
                <div id="productosContainer">
                    <div class="producto-row">
                        <select class="form-control" name="txtProductos[]" data-precio="0" required onchange="actualizarTotal()">
                            <option value="">Seleccione un producto</option>
                            <?php while ($row = $resultProductos->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?php echo htmlspecialchars($row['id_productos']); ?>"
                                        data-precio="<?php echo htmlspecialchars($row['precio_pro']); ?>">
                                    <?php echo htmlspecialchars($row['nombre_pro']); ?> - Precio: $<?php echo htmlspecialchars($row['precio_pro']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" name="cantidades[]" class="form-control cantidadProducto" min="1" value="1" onchange="actualizarTotal()">
                        <button type="button" class="btn btn-danger" onclick="eliminarProducto(this)">Eliminar</button>
                    </div>
                </div>
            </div>

            <button type="button" id="add-producto-btn" class="btn btn-secondary" onclick="agregarProducto()">Agregar otro producto</button>

            <div class="form-group">
                <label for="txtEstadoPedido">Estado del Pedido</label>
                <select class="form-control" name="txtEstadoPedido" required>
                    <option value="">Seleccione el estado del pedido</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Completado">Completado</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>

            <div class="form-group">
                <label for="txtMetodo">Método de Pago:</label>
                <select class="form-control" name="txtMetodo" required>
                    <option value="Transferencia">Transferencia</option>
                    <option value="Pago contra Entrega">Pago contra Entrega</option>
                    <option value="Efectivo">Efectivo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="txtTotal">Total del Pedido:</label>
                <input type="text" id="txtTotal" class="form-control" name="txtTotal" readonly style="background-color: #f8f9fa; cursor: default; user-select: none;">
            </div>

            <div class="form-group">
            <label for="txtTotalSinIVA">Total Sin IVA:</label>
            <input type="text" id="txtTotalSinIVA" class="form-control" name="txtTotalSinIVA" readonly style="background-color: #f8f9fa; cursor: default; user-select: none;">
            </div>

            <div class="form-group">
                <label for="txtIVA">IVA (19%):</label>
                <input type="text" id="txtIVA" class="form-control" name="txtIVA" readonly style="background-color: #f8f9fa; cursor: default; user-select: none;">
            </div>

            <input type="hidden" id="txtDescuento" name="txtDescuento" value="0">

 

            <input type="submit" class="btn btn-primary" value="Registrar Pedido">
        </form>
    </div>
</div>

<script>
// Función para agregar nuevos productos
function agregarProducto() {
    const container = document.getElementById('productosContainer');
    const newProductoRow = document.createElement('div');
    newProductoRow.classList.add('producto-row');

    newProductoRow.innerHTML = `
        <select class="form-control" name="txtProductos[]" data-precio="0" required onchange="actualizarTotal()">
            <option value="">Seleccione un producto</option>
            <?php
            // Obtener nuevamente los productos
            $resultProductos->execute();
            while ($row = $resultProductos->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo htmlspecialchars($row['id_productos']); ?>"
                        data-precio="<?php echo htmlspecialchars($row['precio_pro']); ?>">
                    <?php echo htmlspecialchars($row['nombre_pro']); ?> - Precio: $<?php echo htmlspecialchars($row['precio_pro']); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidades[]" class="form-control cantidadProducto" min="1" value="1" onchange="actualizarTotal()">
        <button type="button" class="btn btn-danger" onclick="eliminarProducto(this)">Eliminar</button>
    `;

    container.appendChild(newProductoRow);
    actualizarTotal(); // Actualiza el total después de agregar un nuevo producto
}

function eliminarProducto(button) {
    const row = button.parentElement;
    row.remove();
    actualizarTotal(); // Actualiza el total después de eliminar un producto
}

function actualizarTotal() {
    const productos = document.querySelectorAll('select[name="txtProductos[]"]');
    const cantidades = document.querySelectorAll('input[name="cantidades[]"]');
    let total = 0;
    let cantidadTotalProductos = 0;
    let descuentoAplicado = 0; // Variable para almacenar el descuento total

    productos.forEach((producto, index) => {
        const precio = parseFloat(producto.options[producto.selectedIndex].dataset.precio) || 0;
        const cantidad = parseFloat(cantidades[index].value) || 0;

        // Suma el precio multiplicado por la cantidad
        total += precio * cantidad;
        cantidadTotalProductos += cantidad; // Acumula la cantidad total de productos seleccionados

        // Lógica para aplicar descuento
        let descuento = 0;
        if (cantidad > 5) { // Aplicar descuento solo si la cantidad es mayor a 5
            if (cantidad > 11) {
                descuento = 0.30; 
            } else if (cantidad > 5) {
                descuento = 0.20; 
            }
        }

        // Calcular el descuento para este producto
        if (descuento > 0) {
            descuentoAplicado += precio * cantidad * descuento; // Sumar el descuento
        }
    });

    total -= descuentoAplicado; // Resta el total de descuentos al total final

    // Calcular IVA (19%)
    const iva = total * 0.19; // 19% de IVA
    const totalConIVA = total + iva; // Total final con IVA

    // Actualizar los inputs con el total y el IVA (mostrando tres decimales)
    document.getElementById('txtTotal').value = totalConIVA.toFixed(3);
    document.getElementById('txtTotalSinIVA').value = total.toFixed(3); // Mostrar total sin IVA
    document.getElementById('txtIVA').value = iva.toFixed(3); // Actualizar el campo de IVA

    // Pasar el descuento total a un campo oculto
    document.getElementById('txtDescuento').value = descuentoAplicado.toFixed(3); // Asegúrate de tener un campo oculto para el descuento
}

</script>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['txtFecha'];
    $cliente_id = $_POST['txtCliente'];
    $estado_pedido = $_POST['txtEstadoPedido'];
    $metodos_pago = $_POST['txtMetodo'];
    $totalConIVA = $_POST['txtTotal']; // Usar el total que incluye IVA
    $totalSinIVA = $_POST['txtTotalSinIVA']; // Obtener el total sin IVA
    $descuento = $_POST['txtDescuento']; // Obtener el descuento

    try {
        // Insertar el pedido en la tabla "pedidos"
        $sqlPedido = 'INSERT INTO pedidos (fecha_ped, estado_ped, metodos_pago, total_ped, total_sin_iva, descuento, id_cliente) 
                      VALUES (:f, :ep, :m, :t, :tsi, :d, :c)';
        $stmtPedido = $conexion->prepare($sqlPedido);
        $stmtPedido->execute([
            ':f' => $fecha,
            ':ep' => $estado_pedido,
            ':m' => $metodos_pago,
            ':t' => $totalConIVA, // Guardar el total que incluye IVA
            ':tsi' => $totalSinIVA, // Guardar el total sin IVA
            ':d' => $descuento, // Guardar el descuento
            ':c' => $cliente_id
        ]);

        $id_pedido = $conexion->lastInsertId(); // Obtener el último ID de pedido insertado

        // Insertar los detalles del pedido
        $productos = $_POST['txtProductos'];
        $cantidades = $_POST['cantidades'];

        foreach ($productos as $index => $producto_id) {
            $cantidad = $cantidades[$index];

            $sqlDetalle = 'INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad) VALUES (:id_p, :id_pro, :cantidad)';
            $stmtDetalle = $conexion->prepare($sqlDetalle);
            $stmtDetalle->execute([
                ':id_p' => $id_pedido,
                ':id_pro' => $producto_id,
                ':cantidad' => $cantidad
            ]);
        }

        echo "Pedido registrado exitosamente!";
    } catch (PDOException $e) {
        echo "Error al registrar el pedido: " . $e->getMessage();
    }
}


?>
