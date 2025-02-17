<?php include("includes/header.php") ?>

<div class="container-fluid">

    <div class="row">

        <div class="row">
            <div class="col-sm-12">

            </div>
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1><?php echo $resultado->titulo; ?></h1>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid img-thumbnail" src="<?php echo RUTA_FRONT; ?>img/articulos/<?php echo $resultado->imagen; ?>">
                    </div>

                    <p><?php echo $resultado->texto; ?></p>

                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-sm-6 offset-3">
            <form method="POST" action="">
                <input type="hidden" name="articulo" value="<?php echo $idArticulo; ?>">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario:</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo isset($resultado3[0]) && is_object($resultado3[0]) ? $resultado3[0]->usuario_email : ''; ?>">
                </div>

                <div class="mb-3">
                    <label for="comentario">Comentario</label>
                    <textarea class="form-control" name="comentario" style="height: 200px"></textarea>
                </div>

                <br />
                <button type="submit" name="enviarComentario" class="btn btn-primary w-100" ><i class="bi bi-person-bounding-box"></i> Crear Nuevo Comentario</button>
            </form>
        </div>
    </div>

</div>

<!-- comentarios de los articulos -->
<div class="row">
    <h3 class="text-center mt-5">Comentarios</h3>

    <?php foreach ($resultado2 as $comentario) : ?>

        <h4><i class="bi bi-person-circle"></i>&nbsp;<?php echo 'Usuario: ' . $comentario->nombre_usuario; ?></h4>
        <p><?php echo 'Mensaje: ' . $comentario->comentario; ?></p>
    <?php endforeach; ?>

</div>


</div>
<?php include("includes/footer.php") ?>