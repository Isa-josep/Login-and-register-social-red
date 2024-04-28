<?php
    include_once ('config/conexion.php');
    if(isset($_POST["enviar"]) && $_POST["enviar"]=="si"){
        require_once ('model/Usuario.php');
        $usuario= new Usuario();
        $usuario->login();
    }
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Acceso | Tec Export</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- preloader css -->
        <link rel="stylesheet" href="static/css/preloader.min-1.css" type="text/css">
        <!-- Bootstrap Css -->
        <link href="static/css/bootstrap.min-1.css" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="static/css/icons.min-1.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="static/css/app.min-1.css" id="app-style" rel="stylesheet" type="text/css">
    </head>
    <body>
    <!-- <body data-layout="horizontal"> -->
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5 text-center">
                                        <a href="index-1.html" class="d-block auth-logo">
                                            <img src="static/picture/logo-sm-1.svg" alt="" height="28"> <span class="logo-txt">Minia</span>
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <h5 class="mb-0">Tec Export!</h5>
                                            <p class="text-muted mt-2">Inicie sesion para continual .</p>
                                        </div>
                                        <form class="custom-form mt-4 pt-2" action="" method="post" >
                                            <div class="mb-3">
                                                <label class="form-label">Correo Electronico</label>
                                                <input type="email" class="form-control" id="usu_correo" name="usu_correo" placeholder="Ingrese Correo">
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1">
                                                        <label class="form-label">Contraseña</label>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="">
                                                            <a href="view/recuperar/index.php" class="text-muted">¿Olvidaste tu contraseña?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="input-group auth-pass-inputgroup">
                                                    <input type="password" class="form-control" id="usu_pass" name="usu_pass" placeholder="Ingrese contraseña" aria-label="Password" aria-describedby="password-addon">
                                                    <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="remember-check">
                                                        <label class="form-check-label" for="remember-check">
                                                            Recuerdame
                                                        </label>
                                                    </div>  
                                                </div>
                                                
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="enviar" value="si">
                                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Ingresar</button>
                                            </div>
                                        </form>

                                        <!-- <div class="mt-4 pt-2 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="font-size-14 mb-3 text-muted fw-medium">- Ingresar con -</h5>
                                            </div>

                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void()" class="social-list-item bg-primary text-white border-primary">
                                                        <i class="mdi mdi-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void()" class="social-list-item bg-info text-white border-info">
                                                        <i class="mdi mdi-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void()" class="social-list-item bg-danger text-white border-danger">
                                                        <i class="mdi mdi-google"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div> -->

                                        <div class="mt-5 text-center">
                                            <p class="text-muted mb-0">¿No tienes cuenta ? <a href="view/register/index.php" class="text-primary fw-semibold">Registrate</a> </p>
                                        </div>
                                    </div>
                                    <div class="mt-4 mt-md-5 text-center">
                                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Export-Tec <i class="mdi mdi-heart text-danger"></i> by Isauro-Paredes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
                    <?php include_once 'view/html/shared/carrucel.php'; ?>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>


        <!-- JAVASCRIPT -->
        <script src="static/js/jquery.min-1.js"></script>
        <script src="static/js/bootstrap.bundle.min-1.js"></script>
        <script src="static/js/metisMenu.min-1.js"></script>
        <script src="static/js/simplebar.min-1.js"></script>
        <script src="static/js/waves.min-1.js"></script>
        <script src="static/js/feather.min-1.js"></script>
        <!-- pace js -->
        <script src="static/js/pace.min-1.js"></script>
        <!-- password addon init -->
        <script src="static/js/pass-addon.init-1.js"></script>

    </body>

</html>