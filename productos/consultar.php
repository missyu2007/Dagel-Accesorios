<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Proyecto SENA</title>
  <link rel="stylesheet" href="estiloform.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php 
include('../index/barra.php');
?>

<a href="../productos/productos.php"><i class='bx bx-arrow-back' style="font-size: 48px; color: #4d6e18;"></i></a>

<div class="container-sm">
    <table class="table table-striped caption-top">
        <caption>Lista de productos</caption>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Categoría</th>
                <th scope="col">Ubicación</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
        require_once('../conexion.php');

        // Consulta para obtener categorías
        $categoriaSQL = 'SELECT id_categoria, nombre_cat FROM categoria';
        try {
            $stmtCat = $conexion->prepare($categoriaSQL);
            $stmtCat->execute();
            $categorias = $stmtCat->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger">Ocurrió un error al cargar los datos.</div>';
            exit;
        }

        // Consulta SQL de productos
        $SQL = 'SELECT p.id_productos, p.nombre_pro, p.descripcion_pro, p.precio_pro, p.cantidad_stock, 
                c.nombre_cat, p.categoria_pro, p.modulo, p.stand, p.cara, p.entre_paño,
                CONCAT(p.modulo, " - ", p.stand, " - ", p.cara, " - ", p.entre_paño) AS ubicacion
                FROM productos p
                LEFT JOIN categoria c ON p.categoria_pro = c.id_categoria';

        try {
            $stmt = $conexion->prepare($SQL);
            $stmt->execute();
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger">Ocurrió un error al cargar los datos.</div>';
            exit;
        }

        if ($rows) {
            foreach ($rows as $row) {
        ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_productos']) ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_pro']) ?></td>
                    <td><?php echo htmlspecialchars($row['descripcion_pro']) ?></td>
                    <td><?php echo htmlspecialchars($row['precio_pro']) ?></td>
                    <td><?php echo htmlspecialchars($row['cantidad_stock']) ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_cat']) ?></td>
                    <td><?php echo htmlspecialchars($row['ubicacion']) ?></td>
                    <td>
                        <form action="eliminar.php" method="POST" style="display:inline;">
                            <input type="hidden" name="txtID" value="<?php echo htmlspecialchars($row['id_productos']); ?>">
                            <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                        </form>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal"
                        data-id="<?php echo htmlspecialchars($row['id_productos']); ?>"
                        data-nombre="<?php echo htmlspecialchars($row['nombre_pro']); ?>"
                        data-descripcion="<?php echo htmlspecialchars($row['descripcion_pro']); ?>"
                        data-precio="<?php echo htmlspecialchars($row['precio_pro']); ?>"
                        data-stock="<?php echo htmlspecialchars($row['cantidad_stock']); ?>"
                        data-categoria="<?php echo htmlspecialchars($row['categoria_pro']); ?>"
                        data-modulo="<?php echo htmlspecialchars($row['modulo']); ?>"
                        data-stand="<?php echo htmlspecialchars($row['stand']); ?>"
                        data-cara="<?php echo htmlspecialchars($row['cara']); ?>"
                        data-entre_paño="<?php echo htmlspecialchars($row['entre_paño']); ?>">
                        Actualizar
                        </button>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo '<tr><td colspan="8" class="text-center">No hay productos registrados.</td></tr>';
        }
        ?>
        </tbody>
    </table> 
</div>

<?php
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') {
        echo '<div class="alert alert-success">Producto eliminado con éxito.</div>';
    } elseif ($_GET['status'] == 'error') {
        echo '<div class="alert alert-danger">Hubo un error al eliminar el Producto.</div>';
    } elseif ($_GET['status'] == 'invalid') {
        echo '<div class="alert alert-warning">ID del Producto no es válido.</div>';
    }
}
?>

<!-- Modal para actualizar producto -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actualizar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateForm" action="actual_pro.php" method="POST">
                    <input type="hidden" name="id_productos" id="productId">
                    <div class="form-group">
                        <label for="productName">Nombre</label>
                        <input type="text" class="form-control" id="productName" name="nombre_pro" required pattern=".{1,}" aria-label="Nombre del producto">
                    </div>
                    <div class="form-group">
                        <label for="productDescription">Descripción</label>
                        <textarea class="form-control" id="productDescription" name="descripcion_pro" required aria-label="Descripción del producto"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Precio</label>
                        <input type="number" class="form-control" id="productPrice" name="precio_pro" required aria-label="Precio del producto">
                    </div>
                    <div class="form-group">
                        <label for="productStock">Stock</label>
                        <input type="number" class="form-control" id="productStock" name="cantidad_stock" required aria-label="Cantidad de stock">
                    </div>
                    <div class="form-group">
                        <label for="productCategory">Categoría</label>
                        <select class="form-control" id="productCategory" name="categoria_pro" required aria-label="Categoría del producto">
                            <option value="">Seleccionar categoría</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?php echo htmlspecialchars($categoria['id_categoria']); ?>">
                                    <?php echo htmlspecialchars($categoria['nombre_cat']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="ubicacion">
                    <h3>Ubicación</h3>
                    <div class="form-group">
                        <label for="txtUbiModulo">Módulo</label>
                        <input type="number" class="form-control" id="txtUbiModulo" name="modulo" required aria-label="Módulo del producto">
                    </div>
                    <div class="form-group">
                        <label for="txtUbiStand">Stand</label>
                        <input type="number" class="form-control" id="txtUbiStand" name="stand" required aria-label="Stand del producto">
                    </div>
                    <div class="form-group">
                        <label for="txtUbiCara">Cara</label>
                        <input type="number" class="form-control" id="txtUbiCara" name="cara" required aria-label="Cara del producto">
                    </div>
                    <div class="form-group">
                        <label for="txtUbiEntrePano">Entrepaño</label>
                        <input type="number" class="form-control" id="txtUbiEntrePaño" name="entre_paño" required aria-label="Entrepaño del producto">
                    </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
   $('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id'); // Cambiar 'id' por el nombre correcto
    var nombre = button.data('nombre'); // Cambiar 'nombre' por el nombre correcto
    var descripcion = button.data('descripcion');
    var precio = button.data('precio');
    var stock = button.data('stock');
    var categoria = button.data('categoria'); // Asegúrate que esto está correcto
    var modulo = button.data('modulo');
    var stand = button.data('stand');
    var cara = button.data('cara');
    var entre_pano = button.data('entre_paño'); // Asegúrate de que esto está correcto

    var modal = $(this);
    modal.find('#productId').val(id);
    modal.find('#productName').val(nombre);
    modal.find('#productDescription').val(descripcion);
    modal.find('#productPrice').val(precio);
    modal.find('#productStock').val(stock);
    modal.find('#productCategory').val(categoria);
    modal.find('#txtUbiModulo').val(modulo);
    modal.find('#txtUbiStand').val(stand);
    modal.find('#txtUbiCara').val(cara);
    modal.find('#txtUbiEntrePano').val(entre_paño);
});


</script>
</body>
</html>
