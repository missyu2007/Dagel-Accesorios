<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dagel</title>
  <link rel="stylesheet" href="../productos/estiloform.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<?php include('../index/barra.php'); ?>

<a href="../proveedores/proveedores.php"><i class='bx bx-arrow-back' style="font-size: 48px; color: #4d6e18;"></i></a>

<div class="container-sm">
    <table class="table caption-top">
        <caption>Lista de Proveedores</caption>
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre del proveedor</th>
            <th scope="col">Contacto del proveedor</th>
            <th scope="col">Condición de pago</th>
            <th scope="col">Producto suministrado</th>
            <th scope="col">Cantidad de productos</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once('../conexion.php');
            try {
              $SQL = 'SELECT id_proveedor, nombre_prov, contacto_prov, con_pago, productos_sum, can_stock FROM proveedores';
              $stmt = $conexion->prepare($SQL);
              $stmt->execute();
              $rows = $stmt->fetchALL(\PDO::FETCH_ASSOC);
              foreach ($rows as $row) {
            ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_proveedor']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre_prov']); ?></td>
                        <td><?php echo htmlspecialchars($row['contacto_prov']); ?></td>
                        <td><?php echo htmlspecialchars($row['con_pago']); ?></td>
                        <td><?php echo htmlspecialchars($row['productos_sum']); ?></td>
                        <td><?php echo htmlspecialchars($row['can_stock']); ?></td>

                        <td>
                            <form action="elimi_prov.php" method="POST" style="display:inline;">
                                <input type="hidden" name="txtID" value="<?php echo htmlspecialchars($row['id_proveedor']); ?>">
                                <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                            </form>
                            <br>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal"
                                    data-id_proveedor="<?php echo htmlspecialchars($row['id_proveedor']); ?>"
                                    data-nombre_prov="<?php echo htmlspecialchars($row['nombre_prov']); ?>"
                                    data-contacto_prov="<?php echo htmlspecialchars($row['contacto_prov']); ?>"
                                    data-con_pago="<?php echo htmlspecialchars($row['con_pago']); ?>"
                                    data-productos_sum="<?php echo htmlspecialchars($row['productos_sum']); ?>"
                                    data-can_stock="<?php echo htmlspecialchars($row['can_stock']); ?>">
                                Actualizar
                            </button>
                        </td>
                    </tr>
                    <?php
                }
            } catch (PDOException $e) {
                echo '<tr><td colspan="4" class="text-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
            }
            ?>
        </tbody>
    </table> 
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar Proveedores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="modal-update-form">
          <input type="hidden" name="id_proveedor" id="modal-id-proveedor">
          <div class="form-group">
            <label for="nombre_prov">Nombre del Proveedor:</label>
            <input type="text" class="form-control" id="modal-nombre-prov" name="nombre_prov" >
          </div>
          <div class="form-group">
            <label for="productos_sum">Productos suministrados:</label>
            <textarea class="form-control" id="modal-productos-sum" name="productos_sum"></textarea>
          </div>
          <div class="form-group">
            <label for="con_pago">Condición de pago:</label>
            <input type="text" class="form-control" id="modal-con-pago" name="con_pago" >
          </div>
          <div class="form-group">
            <label for="can_stock">Cantidad stock:</label>
            <input type="text" class="form-control" id="modal-can-stock" name="can_stock" >
          </div>
          <div class="form-group">
            <label for="contacto_prov">Contacto proveedor:</label>
            <input type="text" class="form-control" id="modal-contacto-prov" name="contacto_prov">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    modal.find('#modal-id-proveedor').val(button.data('id_proveedor'));
    modal.find('#modal-nombre-prov').val(button.data('nombre_prov'));
    modal.find('#modal-contacto-prov').val(button.data('contacto_prov'));
    modal.find('#modal-con-pago').val(button.data('con_pago'));
    modal.find('#modal-productos-sum').val(button.data('productos_sum'));
    modal.find('#modal-can-stock').val(button.data('can_stock'));
  });

  $('#modal-update-form').on('submit', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        type: 'POST',
        url: 'actual_prov.php',
        data: formData,
        success: function(response) {
            var jsonResponse = JSON.parse(response);
            if (jsonResponse.success) {
                alert(jsonResponse.message);
                $('#updateModal').modal('hide');
                location.reload(true);
            } else {
                alert(jsonResponse.message);
            }
        },
        error: function() {
            alert('Ocurrió un error al actualizar el proveedor');
        }
    });
  });
</script>

</body>
</html>
