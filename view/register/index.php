
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Registro | Export Tec</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">

        <link href="../../static/css/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <!-- preloader css -->
        <link rel="stylesheet" href="../../static/css/preloader.min.css" type="text/css">

        <!-- Bootstrap Css -->
        <link href="../../static/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="../../static/css/icons.min.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="../../static/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

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
                                        <a href="index.html" class="d-block auth-logo">
                                            <img src="../../static/picture/logo-sm.svg" alt="" height="28"> <span class="logo-txt">Tec Export</span>
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <h5 class="mb-0">Registra tu cuenta</h5>
                                            <!-- <p class="text-muted mt-2">Get your free Minia account now.</p> -->
                                        </div>
                                        <form id="mnt_form" class="needs-validation custom-form mt-4 pt-2" novalidate="" action="index.html">
                                            <div class="mb-3">
                                                <label for="usu_correo" class="form-label">Correo</label>
                                                <input type="email" class="form-control" id="usu_correo" name="usu_correo" placeholder="Ingrese su correo" required="">  
                                                <div class="validation-error text-danger"></div>      
                                            </div>
                    
                                            <div class="mb-3">
                                                <label for="usu_nombre" class="form-label">Nombre Y Apellido</label>
                                                <input type="text" class="form-control" id="usu_nombre" name="usu_nombre" placeholder="Ingrese su nombre" required="">
                                                <div class="validation-error text-danger"></div> 
                                            </div>

                                            <div class="mb-3">
                                                <label for="usu_pass" class="form-label">Contraseña</label>
                                                <input type="password" class="form-control" id="usu_pass" name="usu_pass" placeholder="Ingrese Contraseña" required="">
                                                <div class="validation-error text-danger"></div>  
                                            </div>

                                            <div class="mb-3">
                                                <label for="usu_pass_confir" class="form-label"> Confirmar Contraseña</label>
                                                <input type="password" class="form-control" id="usu_pass_confir" name="usu_pass_confir" placeholder="Confirmar Contraseña" required="">
                                                <div class="validation-error text-danger"></div>     
                                            </div>

                                            <div class="mb-4">
                                                <p class="mb-0">Al registrarce aceptas los <a href="#" class="text-primary"><strong>Terminos y condiciones</strong></a></p>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Registrarse</button>
                                            </div>
                                        </form>

                                        <!-- <div class="mt-4 pt-2 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign up using -</h5>
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
                                            <p class="text-muted mb-0">¿Ya tiene un cuenta? <a href="../../index.php" class="text-primary fw-semibold"> Inicie sesion </a> </p>
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
                    <?php include_once '../../view/html/shared/carrucel.php'; ?>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>


        <!-- JAVASCRIPT -->
        <script src="../../static/js/jquery.min.js"></script>
        <script src="../../static/js/bootstrap.bundle.min.js"></script>
        <script src="../../static/js/metisMenu.min.js"></script>
        <script src="../../static/js/simplebar.min.js"></script>
        <script src="../../static/js/waves.min.js"></script>
        <script src="../../static/js/feather.min.js"></script>
        <!-- pace js -->
        <script src="../../static/js/pace.min.js"></script>
        <!-- Sweet Alerts js -->
        <script src="../../static/js/sweetalert2.min.js"></script>
        <!-- validation js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/validator/13.6.0/validator.min.js"></script>
        <script type="text/javascript" src="registro.js"></script>

    </body>

</html>