<?php include_once './includes/header.php' ?>


    <div class="row">
        <div class="col-sm-12">
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?php echo $error; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <h3>Editar Artículo</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 offset-3">
            
            <form method="POST" action="" enctype="multipart/form-data">

                <input type="hidden" name="id" value=" <?php echo $resultado->id ?>">

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" value=" <?php echo $resultado->titulo ?>">
                </div>

                <div class="mb-3">
                    <img class="img-fluid img-thumbnail" src="<?php echo RUTA_FRONT . "img/articulos/" . $resultado->imagen ?>">
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Selecciona una imagen">
                </div>
                <div class="mb-3">
                    <label for="texto">Texto</label>
                    <textarea class="form-control" placeholder="Escriba el texto de su artículo" name="texto" style="height: 200px">
                    <?php echo $resultado->texto ?>
                        </textarea>
                </div>

                <br />
                <button type="submit" name="editarArticulo" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Editar Artículo</button>

                <button type="submit" name="borrarArticulo" class="btn btn-danger float-right"><i class="bi bi-person-bounding-box"></i> Borrar Artículo</button>
            </form>
        </div>
    </div>
    
    <?php include_once './includes/footer.php' ?>