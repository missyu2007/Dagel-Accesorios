<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dagel - Pedidos</title>
    <link rel="stylesheet" href="../productos/estiloform.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> <!-- jsPDF -->
</head>
<body>

<?php include('../index/barra.php'); ?>
<a href="../pedidos/pedidos.php"><i class='bx bx-arrow-back' style="font-size: 48px; color: #4d6e18;"></i></a>

<div class="container-sm mt-3">
    <h2>Lista de pedidos</h2>
    <table class="table caption-top table-striped">
        <thead>
            <tr>
                <th scope="col">ID Pedido</th>
                <th scope="col">Fecha del Pedido</th>
                <th scope="col">Estado del Pedido</th>
                <th scope="col">Total del Pedido (IVA)</th>
                <th scope="col">Total sin IVA</th>
                <th scope="col">Descuento Aplicado</th>
                <th scope="col">Nombre del Cliente</th>
                <th scope="col">Apellido</th>
                <th scope="col">Productos</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once('../conexion.php');

            $SQL = 'SELECT p.id_pedidos, p.fecha_ped, p.estado_ped, p.total_ped, p.total_sin_iva, p.descuento, c.nombre_cli, c.apellido_cli, 
                    COALESCE(GROUP_CONCAT(CONCAT(prod.nombre_pro, " (", dp.cantidad, ") - $", prod.precio_pro) SEPARATOR ", "), "Sin productos") AS productos,
                    COALESCE(SUM(prod.precio_pro * dp.cantidad), 0) AS total_productos
                    FROM pedidos p
                    JOIN clientes c ON p.id_cliente = c.id_cliente
                    LEFT JOIN detalle_pedido dp ON p.id_pedidos = dp.id_pedido
                    LEFT JOIN productos prod ON dp.id_producto = prod.id_productos
                    GROUP BY p.id_pedidos
                    ORDER BY p.id_pedidos ASC';

            $stmt = $conexion->prepare($SQL);
            $stmt->execute();
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($rows) {
                foreach ($rows as $row) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_pedidos']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha_ped']); ?></td>
                        <td><?php echo htmlspecialchars($row['estado_ped']); ?></td>
                        <td><?php echo '$' . number_format(htmlspecialchars($row['total_ped']), 3, '.', ','); ?></td>
                        <td><?php echo '$' . number_format(htmlspecialchars($row['total_sin_iva']), 3, '.', ','); ?></td>
                        <td><?php echo htmlspecialchars($row['descuento']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre_cli']); ?></td>
                        <td><?php echo htmlspecialchars($row['apellido_cli']); ?></td>
                        <td><?php echo htmlspecialchars($row['productos']); ?></td>
                        <td>
                            <form action="elimi_ped.php" method="POST" style="display:inline;">
                                <input type="hidden" name="txtID" value="<?php echo htmlspecialchars($row['id_pedidos']); ?>">
                                <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                            </form>
                            <br>
                            <form action="actual_ped.php" method="POST" style="display:inline;">
                                <input type="hidden" name="txtID" value="<?php echo htmlspecialchars($row['id_pedidos']); ?>">
                                <input type="submit" class="btn btn-warning btn-sm" value="Actualizar">
                            </form>
                            <br>
                            <!-- Botón para descargar factura en PDF -->
                            <button class="btn btn-primary btn-sm" onclick="downloadInvoice(<?php echo htmlspecialchars($row['id_pedidos']); ?>, '<?php echo htmlspecialchars($row['nombre_cli']); ?>', '<?php echo htmlspecialchars($row['productos']); ?>', <?php echo htmlspecialchars($row['total_sin_iva']); ?>, <?php echo htmlspecialchars($row['total_ped']); ?>, <?php echo htmlspecialchars($row['descuento']); ?>)">
                                Descargar Factura
                            </button>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="9" class="text-center">No hay pedidos registrados.</td></tr>';
            }
            ?>
        </tbody>
    </table> 
</div> 

<!-- Scripts de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Función para descargar la factura en PDF
    function downloadInvoice(id, cliente, productos, totalSinIVA, totalPed, descuento) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        

        // Título de la factura
        doc.setFontSize(16);
        doc.setFont("times", "bold");
        doc.text('Factura para el Pedido ID: ' + id, 10, 10);

        doc.setFontSize(16);
    doc.setFont("times", "italic");
    doc.setTextColor(0, 0, 0); // Color negro
    doc.text('Tu Marca Aquí', 10, 20);

        // Información del cliente
        doc.setFontSize(12);
        doc.setFont("times", "normal");
        doc.text('Cliente: ' + cliente, 10, 20);

        // Encabezado de la tabla
        const startY = 30; // Posición inicial Y para la tabla
        const columnWidths = [60, 30, 40, 40]; // Ancho de las columnas
        const headers = ["Producto", "Cantidad", "Total sin IVA", "Total con IVA"];
        
        // Dibuja los encabezados
        doc.setFontSize(12);
        doc.setFont("times", "bold");
        for (let i = 0; i < headers.length; i++) {
            doc.text(headers[i], 10 + i * columnWidths[i], startY);
        }

        // Línea debajo de los encabezados
        doc.setLineWidth(0.5);
        doc.line(10, startY + 5, 10 + columnWidths.reduce((a, b) => a + b), startY + 5);

        // Detalle de productos
        const productArray = productos.split(", "); // Convierte los productos en un array
        const productDetails = []; // Para almacenar detalles de productos y sus totales

        productArray.forEach((product) => {
            const quantity = parseInt(product.match(/\((\d+)\)/)[1]); // Extrae la cantidad
            const productInfo = product.split(" - $"); // Extrae nombre y precio
            const productName = productInfo[0]; // Nombre del producto
            const productPrice = parseFloat(productInfo[1]); // Precio del producto

            productDetails.push({ name: productName, quantity: quantity, price: productPrice });
        });

        productDetails.forEach((item, index) => {
            const yPosition = startY + 10 + index * 10; // Incrementa la posición Y para cada fila
            
            // Detalle del producto
            doc.setFontSize(12);
            doc.setFont("times", "normal");
            doc.text(item.name, 10, yPosition);
            doc.text(item.quantity.toString(), 10 + columnWidths[0], yPosition);
            doc.text('$' + (item.price * item.quantity).toFixed(3), 10 + columnWidths[0] + columnWidths[1], yPosition);
            doc.text('$' + (item.price * item.quantity * 1.21).toFixed(3), 10 + columnWidths[0] + columnWidths[1] + columnWidths[3], yPosition); // Asumiendo IVA del 21%

            // Línea separadora para cada fila
            doc.setLineWidth(0.5);
            doc.line(10, yPosition + 2, 10 + columnWidths.reduce((a, b) => a + b), yPosition + 2);
        });

        // Total del pedido y descuento
        const totalYPosition = startY + 10 + productDetails.length * 10 + 10; // Ajusta la posición para mostrar totales
        doc.setFontSize(12);
        doc.text('Total del Pedido (IVA): $' + totalPed.toFixed(3), 10, totalYPosition);
        doc.text('Total sin IVA: $' + totalSinIVA.toFixed(3), 10, totalYPosition + 10);
        doc.text('Descuento Aplicado: ' + descuento, 10, totalYPosition + 20);

        // Genera el PDF
        doc.save('factura_pedido_' + id + '.pdf');
    }
</script>
</body>
</html>
