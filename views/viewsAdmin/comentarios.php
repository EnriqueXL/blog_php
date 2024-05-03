<?php include_once './includes/header.php'; ?>

<div class="row">
    <div class="col-sm-6">
        <h3>Lista de Comentarios</h3>
    </div>
</div>
<div class="row mt-2 caja">
    <div class="col-sm-12">
        <table id="tblContactos" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Comentario</th>
                    <th>Usuario</th>
                    <th>Artículo</th>
                    <th>Estado</th>
                    <th>Fecha de creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($listaComentarios as $comentario) : ?>
                    
                <tr>
                    <td><?php echo $comentario->id_comentario; ?></td>
                    <td><?php echo $comentario->comentario; ?></td>
                    <td><?php echo $comentario->nombre_usuario; ?></td>
                    <td><?php echo $comentario->titulo_articulo; ?></td>
                    <!-- Valida el estado del comentario, 0 es no aprobado, 1 es aprobado -->
                    <td><?php echo $comentario->estado == 0 ? 'No aprobado' : 'Aprobado'; ?></td>
                    <td><?php echo $comentario->fecha; ?></td>

                    <td>
                        <!-- Envio el comentario que sera editado para recibirlo con GET -->
                        <a href="editar_comentario.php?id=<?php echo $comentario->id_comentario; ?>"
                            class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                    </td>
                </tr>

                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
<?php include_once './includes/footer.php'; ?>

<script>
$(document).ready(function() {
    $('#tblContactos').DataTable();
});
</script>