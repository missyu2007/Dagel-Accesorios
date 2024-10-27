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

<a href="../categorias/categorias.php"><i class='bx bx-arrow-back' style="font-size: 48px; color: #4d6e18;"></i></a>

<div class="container-sm">
    <table class="table caption-top">
        <caption>Lista de Categorías</caption>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre de la Categoría</th>
                <th scope="col">Descripción de la Categoría</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once('../conexion.php');
            try {
                $SQL = 'SELECT id_categoria, nombre_cat, Descripcion_cat FROM categoria';
                $stmt = $conexion->prepare($SQL);
                $stmt->execute();
                $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                foreach ($rows as $row) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_categoria']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre_cat']); ?></td>
                        <td><?php echo htmlspecialchars($row['Descripcion_cat']); ?></td>
                        <td>
                            <form action="elimi_cat.php" method="POST" style="display:inline;">
                                <input type="hidden" name="txtID" value="<?php echo htmlspecialchars($row['id_categoria']); ?>">
                                <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                            </form>
                            <br>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal"
                                    data-id="<?php echo htmlspecialchars($row['id_categoria']); ?>"
                                    data-nombre="<?php echo htmlspecialchars($row['nombre_cat']); ?>"
                                    data-descripcion="<?php echo htmlspecialchars($row['Descripcion_cat']); ?>">
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
        <h5 class="modal-title">Actualizar Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="modal-update-form"> <!-- Cambiado a un ID específico -->
          <input type="hidden" name="id_categoria" id="modal-id-categoria">
          <div class="form-group">
            <label for="nombre_cat">Nombre de la Categoría:</label>
            <input type="text" class="form-control" id="modal-nombre-cat" name="nombre_cat" required>
          </div>
          <div class="form-group">
            <label for="Descripcion_cat">Descripción de la Categoría:</label>
            <textarea class="form-control" id="modal-descripcion-cat" name="Descripcion_cat" required></textarea>
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
    var descripcion = button.data('descripcion');

    var modal = $(this);
    modal.find('#modal-id-categoria').val(id);
    modal.find('#modal-nombre-cat').val(nombre);
    modal.find('#modal-descripcion-cat').val(descripcion);
  });

  // Enviar el formulario mediante AJAX
  $('#modal-update-form').on('submit', function(e) {
    e.preventDefault(); // Evita la redirección del formulario
    var formData = $(this).serialize(); // Serializa los datos del formulario

    // Envía los datos mediante AJAX
    $.ajax({
        type: 'POST',
        url: 'actual_cat.php', // Archivo PHP que procesa la actualización
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
            alert('Ocurrió un error al actualizar la categoría'); // Mensaje de error en caso de fallo
        }
    });
  });
</script>

</body>
</html>
