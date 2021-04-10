        <?php
date_default_timezone_set("America/Bogota");

require_once "Controlador/conexion.php"; // Importe del archivo conexion php
require_once "Controlador/controlador.php"; // Importe del archivo controlador php

$control  = new Controlador();

if (isset($_GET["accion"])) {

    if ($_GET["accion"] == "ingresar") {
        $control->ingresar($_POST["loginCorreo"], $_POST["loginContra"]);
    } elseif ($_GET["accion"] == "registrar") {
        $control->registrar($_POST["regCorreo"], $_POST["regReContra"]);
    } elseif ($_GET["accion"] == "salir") {
        $control->salir();
    } elseif ($_GET["accion"] == "eliminarInfo") {
        $control->eliminarInformacion($_POST["numEli"]);
    } elseif ($_GET["accion"] == "buscarInfo") {
        $control->cargarTablaBusqueda();
    } elseif ($_GET["accion"] == "agregarInfo") {
        $control->agregarInformacion($_POST["numAgr"], $_POST["nomAgr"], $_POST["fechAgr"]);
    } elseif ($_GET["accion"] == "actualizarInfo") {
        $control->actualizarInformacion($_POST["numActu"], $_POST["nomActu"], $_POST["fechActu"]);
    }
} else {
    require_once "Html/login.php";
}

if (isset($_GET["mensaje"])) {
    if ($_GET["mensaje"] == "usuario") {
        print "<script language='javascript'> alert('Usuario no existente.'); </script>";
    } elseif ($_GET["mensaje"] == "error") {
        print "<script language='javascript'> alert('Contraseña incorrecta.'); </script>";
    } elseif ($_GET["mensaje"] == "conexion") {
        print "<script language='javascript'> alert('Error en la conexion.'); </script>";
    } elseif ($_GET["mensaje"] == "ingreso") {
        print "<script language='javascript'> alert('Vuelva a ingresar porfavor.'); </script>";
    }

}
