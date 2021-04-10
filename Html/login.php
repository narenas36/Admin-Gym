<!-- Creado por la empresa VirtualInnovation
      Copyright libre -->

<html lang="es">
    <head>
        <?php
session_start();
if (isset($_SESSION["usuario"])) {
    header("Location: http://localhost/Admin-Gym/Html/tablaAdmin.php") or exit(1);
}
?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="Html/Css/Imagenes/logo-Con-fondo.png" type="image/x-icon"> <!-- Imagen de icono -->
        <link rel="stylesheet" type="text/css" href="Html/Css/style.css"> <!-- Archivo css -->
        <link rel="stylesheet"  type="text/css" href="Html/Css/bootstrap.css"> <!-- Archivo bootstrap css -->
        <title>Admin-Gym</title>
    <div id="Documento" style="text-align: right; color: white; font-weight: bold;"></div>
    </head>

    <body>
        <!-- Contenedor central -->
        <div class="container rounded-left rounded-right" id="contenedor">
            <div class="row">
                <!-- Contenedor de ingreso o registro -->
                <div  class="col col-md-6 rounded-left" id="contentFormulario">
                    <form id="formLogin" action="index.php?accion=ingresar" method="post">
                        <div class="form-group">
                            <label>Correo:</label>
                            <input type="email" class="form-control" id="loginCorreo" name="loginCorreo" aria-describedby="emailHelp" placeholder="Ingresa tu correo">
                        </div>
                        <div class="form-group">
                            <label>Contraseña:</label>
                            <input type="password" class="form-control" id="loginContra" name="loginContra" placeholder="Ingresa tu contraseña">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn  btn-secondary" id="botonIngresar" value="Ingresar"> <!-- Boton para ingresar -->
                            <input type="button" id="botonRegistrar" class="btn  btn-secondary" data-toggle="modal" data-target="#exampleModal" value="Registrarse"> <!-- Boton para registrarse -->
                        </div>
                    </form>
                </div>
                <!-- Contenedor del logo -->
                <div class="col col-md-6 rounded-right" id="contentLogo">
                    <div class="logo">
                        <img src="Html/Css/Imagenes/logo-sin-fondo.png"> <!-- Logo de la pagina -->
                        <p>Admin-Gym</p>
                        <h6>NicoElCrack©</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formReg" action="index.php?accion=registrar" method="post">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrate!</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                            <label>Correo:</label>
                            <input type="email" class="form-control" id="regCorreo" name="regCorreo" aria-describedby="emailHelp" placeholder="Ingresa tu correo">
                        </div>
                <div class="form-group">
                            <label>Contraseña:</label>
                            <input type="password" class="form-control" id="regContra" name="regContra" placeholder="Ingresa tu contraseña">
                        </div>
                <div class="form-group">
                            <label>Confirmar contraseña:</label>
                            <input type="password" class="form-control" id="regReContra" name="regReContra" placeholder="Ingresa de nuevo tu contraseña">
                        </div>
                    
              </div>
              <div class="modal-footer">
                <button type="button" id="botonCerrarModel" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" id="botonRegistrarModel" class="btn btn-secondary" value="Registrarse">
              </div>
          </form>
            </div>
          </div>
        </div>

        <script type="text/javascript" src="Html/Modelo/Libreria/jquery-3.5.1.js"></script> <!-- Archivo jquery extension js -->
        <script type="text/javascript" src="Html/Modelo/Libreria/jquery-validate.min.js"></script> <!-- Archivo jquery extension js -->
        <script type="text/javascript" src="Html/Modelo/js/bootstrap.js"></script>    <!-- Archivo Bootstrap extension js -->
        <script type="text/javascript" src="Html/Modelo/js/dinamicaLogin.js"></script>    <!-- Archivo javascript (Dinamica del login) -->
    </body>
</html>