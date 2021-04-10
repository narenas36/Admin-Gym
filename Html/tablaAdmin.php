<!-- Creado por la empresa VirtualInnovation
      Copyright libre -->

<html lang="es">
    <head>
        <?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: http://localhost/Admin-Gym/index.php?mensaje=ingreso") or exit(1);
}
?>
        <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" type="text/css" href="Css/style.css"> <!-- Archivo css -->
                    <link rel="shortcut icon" href="Css/Imagenes/logo-Con-fondo.png" type="image/x-icon"> <!-- Imagen de icono -->
                        <link rel="stylesheet"  type="text/css" href="Css/bootstrap.css"> <!-- Archivo bootstrap extension css -->
                            <link rel="stylesheet"  type="text/css" href="Css/jquery-ui.min.css"> <!-- Archivo jquery extension css -->
                                <title>Admin-Gym</title>
                                </head>
                                <body>
                                    <!-- Contenedor de parte superior -->
                                    <header class="row" id="cabezera">
                                        <!-- Contenedor de logo -->
                                        <div class="ajusteCabezera col-md-1 col-sm col offset-md offset-lg-1">
                                            <img src="Css/Imagenes/logo-sin-fondo.png">
                                        </div>
                                        <!-- Contenedor de nombre -->
                                        <div class="col-md-3 col-sm col align-self-end">
                                            <p>Admin-Gym</p>
                                        </div>
                                        <!-- Contenedor de agregar -->
                                        <div class="col-md col-sm col-auto align-self-center">
                                            <a class="col-12" onclick="abrirFormularioAgregar()" title="Agregar">
                                                <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <!-- Contenedor de actualizar -->
                                        <div class="col-md col-sm col-auto align-self-center">
                                            <a class="col-12" onclick="abrirFormularioBuscar()" title="Buscar">
                                                <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-filter-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM3.5 5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zM5 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm2 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <!-- Contenedor de actualizar lista -->
                                        <div class="col-md col-sm col-auto align-self-center">
                                            <a class="col-12" onclick="actualizar()" title="Actualizar">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="3em" height="3em" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 3.293l6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                                                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <!-- Contenedor de salir -->
                                        <div class="col-md col-sm col-auto align-self-center">
                                            <a href="http://localhost/Admin-Gym/index.php?accion=salir" title="Salir">
                                                <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-door-closed-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M4 1a1 1 0 0 0-1 1v13H1.5a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2a1 1 0 0 0-1-1H4zm2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </header>

                                    <!-- Contenedor de tabla -->
                                    <div id="contentTabla">
                                        <div class="container scrollTabla">
                                            <table class="table table-bordered table-hover align-content-center">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">Numero</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Fecha</th>
                                                        <th scope="col">Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="cuerpoTabla">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Contenedor del dialogo para informacion del cliente -->
                                    <div id="infoClient" title="Informacion">
                                        <table>
                                            <tr>
                                                <td>
                                                    Numero:
                                                </td>
                                                <td>
                                                    <input type="text"  id="infoNumero" name="infoNumero" readonly="true" title="Requerido" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Nombre:
                                                </td>
                                                <td>
                                                    <input type="text"  id="infoNombre" name="infoNombre" title="Requerido" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Fecha:
                                                </td>
                                                <td>
                                                    <input type="date"  id="infoFecha" name="infoFecha" title="Requerido" required>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!-- Contenedor del dialogo para agregar cliente -->
                                    <div id="agregarClient" title="Agregar">
                                        <table>
                                            <tr>
                                                <td>
                                                    Numero:
                                                </td>
                                                <td>
                                                    <input type="text"  id="agregarNumero" name="agregarNumero" title="Requerido" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Nombre:
                                                </td>
                                                <td>
                                                    <input type="text"  id="agregarNombre" name="agregarNombre" title="Requerido" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Fecha:
                                                </td>
                                                <td>
                                                    <input type="date"  id="agregarFecha" name="agregarFecha" title="Requerido" required>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!-- Contenedor del dialogo para buscar cliente -->
                                    <div id="buscarClient" title="Buscar">
                                        <table>
                                            <tr>
                                                <td>
                                                    <select id="buscarTipo" name="buscarTipo">
                                                        <option value="ident" selected="true">Numero:</option>
                                                        <option value="nombre">Nombre:</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text"  id="buscarDato" name="buscarDato" title="Requerido" required>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <script type="text/javascript" src="Modelo/Libreria/jquery-3.5.1.slim.js"></script> <!-- Archivo jquery extension js -->
                                    <script type="text/javascript" src="Modelo/Libreria/jquery-3.5.1.js"></script> <!-- Archivo jquery extension js -->
                                    <script type="text/javascript" src="Modelo/Libreria/jquery-validate.min.js"></script> <!-- Archivo jquery extension js -->
                                    <script type="text/javascript" src="Modelo/Libreria/jquery-ui.min.js"></script> <!-- Archivo jquery extension js -->
                                    <script type="text/javascript" src="Modelo/Libreria/loadingoverlay.min.js"></script> <!-- Archivo javascript -->
                                    <script type="text/javascript" src="Modelo/js/dinamicaTablaAdmin.js"></script> <!-- Archivo javascript (Dinamica de la tabla) -->
                                </body>
                                </html>
