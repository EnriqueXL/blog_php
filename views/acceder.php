<?php include_once './includes/header.php' ?>


<div class="container-fluid">
    <h1 class="text-center">Acceso de Usuarios</h1>
    <div class="row">
        <div class="col-sm-6 offset-3">
            <div class="card">
                <div class="card-header">
                    Ingresa tus datos para acceder
                </div>
                <div class="card-body">
                    <form method="POST" action="">

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="Ingresa el email">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Ingresa el password">
                        </div>

                        <br />
                        <div class="mb-3">
                            <button type="submit" name="acceder" class="btn btn-primary w-100"><i
                                    class="bi bi-person-bounding-box"></i> Acceder</button>
                        </div>
                   
                        <!-- <div class="mb-3">
                            <button type="submit" class="btn btn-success w-100"><i
                                    class="bi bi-person-bounding-box"></i> Registrarse</button>
                                   
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once './includes/footer.php' ?>
