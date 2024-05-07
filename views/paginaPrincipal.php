<?php 
    include_once './includes/header.php';
?>

<div class="container">
    <h1 class="text-center">Artículos</h1>
    <div class="row justify-content-center"> <!-- Añadimos la clase justify-content-center para centrar las tarjetas -->
        <?php foreach($resultado as $articulo) : ?>
            <div class="col-sm-4 mb-4"> <!-- Añadimos la clase mb-4 para un poco de espacio entre las tarjetas -->
                <div class="card h-100"> <!-- Añadimos la clase h-100 para asegurar que todas las tarjetas tengan la misma altura -->
                    <img src="<?php echo RUTA_FRONT; ?>img/articulos/<?php echo $articulo->imagen; ?>" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;"> <!-- Establecemos la altura fija de la imagen y el estilo object-fit para que la imagen se ajuste al contenedor -->
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $articulo->titulo; ?></h5>
                        <p><strong><?php echo $articulo->fecha_creacion; ?></strong></p>
                        <p class="card-text"><?php echo $articulo->texto; ?></p>
                        <a href="detalle.php?id=<?php echo $articulo->id; ?>" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php include_once './includes/footer.php'; ?>

