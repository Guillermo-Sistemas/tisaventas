<!DOCTYPE html>
<html lang="es">
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ingreso al Sistema | TIS@</title>
        <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
        <script src="<?php echo base_url; ?>Assets/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Ingreso al Sistema</h3></div>
                                    <div class="card-body">
                                        <form id="frmLogin">
                                            <label for="usuario"><i class="fas fa-user"></i>Usuario</label>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Ingrese Usuario" />
                                                
                                            </div>
                                            <label for="clave"><i class="fas fa-key"></i>Contrase&ntilde;a</label>
                                            <div class="form-floating mb-3">
                                                
                                                <input class="form-control" id="clave" name="clave" type="password" placeholder="Ingrese Contrase�a" />
                                                
                                            </div>
                                            <div class="alert alert-danger text-center d-none" id="alerta" role="alert">

                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary btn-lg btn-block"  type="submit" onclick="frmLogin(event);">Ingresar</button>
                                            </div>
                                           
                                           
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">&copy TIS@ | &#9742; 3218165554</div>
                            
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="<?php echo base_url; ?>Assets/js/jquery-3.6.0.min.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url; ?>Assets/js/scripts.js"></script>

        <script>
            const base_url="<?php echo base_url;?>";
        </script>


        <script src="<?php echo base_url; ?>Assets/js/login.js"></script>
    </body>
</html>