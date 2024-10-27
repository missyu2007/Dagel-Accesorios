<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dagel - Clientes</title>
  <link rel="stylesheet" href="../productos/estiloform.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<?php include('../index/barra.php'); ?>
<a href="../clientes/clientes.php"><i class='bx bx-arrow-back' style="font-size: 48px; color: #4d6e18;"></i></a>

<div class="container-sm">
    <table class="table caption-top">
    <h1>Lista de tus Clientes</h1>
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre del Cliente</th>
            <th scope="col">Apellido del Cliente</th>
            <th scope="col">Dirección del Cliente</th>
            <th scope="col">Correo Electrónico</th>
            <th scope="col">Teléfono del Cliente</th>
            <th scope="col">Historial del Cliente</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once('../conexion.php');
        $SQL = 'SELECT id_cliente, nombre_cli, apellido_cli, direccion_cli, correo_cli, telefono_cli, historial_cli FROM clientes';
        $stmt = $conexion->prepare($SQL);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_cliente']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre_cli']); ?></td>
                <td><?php echo htmlspecialchars($row['apellido_cli']); ?></td>
                <td><?php echo htmlspecialchars($row['direccion_cli']); ?></td>
                <td><?php echo htmlspecialchars($row['correo_cli']); ?></td>
                <td><?php echo htmlspecialchars($row['telefono_cli']); ?></td>
                <td><?php echo htmlspecialchars($row['historial_cli']); ?></td>
                <td>
                    <form action="elimi_cli.php" method="POST" style="display:inline;">
                        <input type="hidden" name="txtID" value="<?php echo htmlspecialchars($row['id_cliente']); ?>">
                        <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                    </form>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal"
                            data-id="<?php echo htmlspecialchars($row['id_cliente']); ?>"
                            data-nombre="<?php echo htmlspecialchars($row['nombre_cli']); ?>"
                            data-apellido="<?php echo htmlspecialchars($row['apellido_cli']); ?>"
                            data-direccion="<?php echo htmlspecialchars($row['direccion_cli']); ?>"
                            data-correo="<?php echo htmlspecialchars($row['correo_cli']); ?>"
                            data-telefono="<?php echo htmlspecialchars($row['telefono_cli']); ?>"
                            data-historial="<?php echo htmlspecialchars($row['historial_cli']); ?>">
                        Actualizar
                    </button>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    </table> 
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar registro del Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="modal-update-form">
          <input type="hidden" name="id_cliente" id="modal-id-cliente">
          <div class="form-group">
            <label for="modal-nombre-cli">Nombre del Cliente:</label>
            <input type="text" class="form-control" id="modal-nombre-cli" name="nombre_cli" required>
          </div>
          <div class="form-group">
            <label for="modal-apellido-cli">Apellido del Cliente:</label>
            <input type="text" class="form-control" id="modal-apellido-cli" name="apellido_cli" required>
          </div>
          <div class="form-group">
            <label for="modal-direccion-cli">Dirección del Cliente:</label>
            <input type="text" class="form-control" id="modal-direccion-cli" name="direccion_cli" required>
          </div>
          <div class="form-group">
            <label for="modal-correo-cli">Correo del Cliente:</label>
            <input type="email" class="form-control" id="modal-correo-cli" name="correo_cli" required>
          </div>
          <div class="form-group">
            <label for="modal-telefono-cli">Teléfono del Cliente:</label>
            <input type="text" class="form-control" id="modal-telefono-cli" name="telefono_cli" required>
          </div>
          <div class="form-group">
            <label for="modal-historial-cli">Historial del Cliente:</label>
            <input type="text" class="form-control" id="modal-historial-cli" name="historial_cli" required>
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
  // Cargar datos en el modal al abrirlo
  $('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var nombre = button.data('nombre');
    var apellido = button.data('apellido');
    var direccion = button.data('direccion');
    var correo = button.data('correo');
    var telefono = button.data('telefono');
    var historial = button.data('historial');

    var modal = $(this);
    modal.find('#modal-id-cliente').val(id);
    modal.find('#modal-nombre-cli').val(nombre);
    modal.find('#modal-apellido-cli').val(apellido);
    modal.find('#modal-direccion-cli').val(direccion);
    modal.find('#modal-correo-cli').val(correo);
    modal.find('#modal-telefono-cli').val(telefono);
    modal.find('#modal-historial-cli').val(historial);
  });

  // Enviar el formulario mediante AJAX
  $('#modal-update-form').on('submit', function(e) {
    e.preventDefault(); // Evita la redirección del formulario
    var formData = $(this).serialize(); // Serializa los datos del formulario

    // Envía los datos mediante AJAX
    $.ajax({
        type: 'POST',
        url: 'actual_cli.php', // Archivo PHP que procesa la actualización
        data: formData,
        success: function(response) {
            var jsonResponse = JSON.parse(response); // Parsear la respuesta JSON
            if (jsonResponse.success) {
                alert(jsonResponse.message); // Mensaje de éxito
                $('#updateModal').modal('hide'); // Cierra el modal
                location.reload(); // Recarga la página para ver los cambios
            } else {
                alert(jsonResponse.message); // Mensaje de error
            }
        },
        error: function() {
            alert('Ocurrió un error al actualizar el registro del Cliente'); // Mensaje de error en caso de fallo
        }
    });
  });
</script>

</body>
</html>
