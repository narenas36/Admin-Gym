<?php
class Controlador
{
    private $servidor = "localhost";

    // Funcion para buscar usuario en base de datos
    public function ingresar($correo, $contra)
    {
        $consulta = "SELECT * FROM usuarios WHERE correo = '$correo'";
        $conexion = new Conexion();
        $num      = $conexion->abrir();
        if ($num != 0) {
            $conexion->consulta($consulta);
            $result = $conexion->resultadoConsulta();
            $filas  = $conexion->resultadoFilas();
            if ($filas > 0) {
                $fila = $result->fetch_object();
                if (password_verify($contra, $fila->contra)) {
                    session_start();
                    $_SESSION["usuario"] = $correo;
                    header("Location: http://" . $this->servidor . "/Admin-Gym/Html/tablaAdmin.php") or exit(1);
                } else {
                    header("Location: http://" . $this->servidor . "/Admin-Gym/index.php?mensaje=error") or exit(1);
                }
            } else {
                header("Location: http://" . $this->servidor . "/Admin-Gym/index.php?mensaje=usuario") or exit(1);
            }
        } else {
            header("Location: http://" . $this->servidor . "/Admin-Gym/index.php?mensaje=conexion") or exit(1);
        }
        $conexion->cerrar();
    }

    public function registrar($correo, $contra)
    {
        strtolower($correo);
        $conexion = new Conexion();
        $num      = $conexion->abrir();
        if ($num != 0) {
            $i = 0;
            $j = 1;
            while ($i < 1) {
                $tabla = "clientes" . $j;
                $conexion->consulta("SELECT * FROM usuarios WHERE tabla = '$tabla'");
                $filas = $conexion->resultadoFilas();
                if ($filas > 0) {
                    $j++;
                } else {

                    $csv = fopen("Tablas/" . $tabla . ".csv", "w");
                    fclose($csv);
                    $contra = password_hash($contra, PASSWORD_DEFAULT, ["cost" => 10]);
                    $conexion->consulta("INSERT INTO usuarios() VALUES('$correo', '$contra', '$tabla')");
                    $filas = $conexion->resultadoFilas();
                    if ($filas > 0) {
                        session_start();
                        $_SESSION["usuario"] = $correo;
                        header("Location: http://" . $this->servidor . "/Admin-Gym/Html/tablaAdmin.php") or exit(1);
                    } else {
                        header("Location: http://" . $this->servidor . "/Admin-Gym/index.php?mensaje=conexion") or exit(1);
                    }
                    $i++;
                }
            }
        } else {
            header("Location: http://" . $this->servidor . "/Admin-Gym/index.php?mensaje=conexion") or exit(1);
        }
        $conexion->cerrar();
    }

    // Funcion para salir del usuario
    public function salir()
    {
        session_start();
        session_destroy();
        header("Location: http://" . $this->servidor . "/Admin-Gym/index.php") or exit(1);
    }

    // Funcion para actualizar datos del cliente en la base de datos
    public function actualizarInformacion($num, $nom, $fecha)
    {
        session_start();
        $correo   = $_SESSION["usuario"];
        $consulta = "SELECT tabla FROM usuarios WHERE correo = '$correo'";
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->consulta($consulta);
        $result = $conexion->resultadoConsulta();
        $filas  = $conexion->resultadoFilas();
        $csv    = array();
        if ($filas > 0) {
            $datos = $result->fetch_object();
            if (($archivo1 = fopen("Tablas/" . $datos->tabla . ".csv", "r")) !== false) {
                while (($fila = fgetcsv($archivo1, 0, ",")) !== false) {
                    if (count($fila) > 0) {
                        array_push($csv, array($fila[0], $fila[1], $fila[2]));
                    }
                }
                if (($archivo2 = fopen("Tablas/" . $datos->tabla . ".csv", "w")) !== false) {
                    foreach ($csv as $arreglo) {
                        if ($arreglo[0] == $num) {
                            $arreglo = array($num, $nom, $fecha);
                        }
                        fputcsv($archivo2, array($arreglo[0], $arreglo[1], $arreglo[2]));
                    }
                    fclose($archivo2);
                    echo 2;
                } else {
                    echo 1;
                }
            } else {
                echo 1;
            }
        } else {
            echo 0;
        }
        $conexion->cerrar();
    }

    // Funcion para eliminar datos del cliente en la base de datos
    public function eliminarInformacion($num)
    {
        session_start();
        $correo   = $_SESSION["usuario"];
        $consulta = "SELECT tabla FROM usuarios WHERE correo = '$correo'";
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->consulta($consulta);
        $result = $conexion->resultadoConsulta();
        $filas  = $conexion->resultadoFilas();
        $csv    = array();
        if ($filas > 0) {
            $datos = $result->fetch_object();
            if (($archivo1 = fopen("Tablas/" . $datos->tabla . ".csv", "r")) !== false) {
                while (($fila = fgetcsv($archivo1, 0, ",")) !== false) {
                    if (count($fila) > 0) {
                        array_push($csv, array($fila[0], $fila[1], $fila[2]));
                    }
                }
                if (($archivo2 = fopen("Tablas/" . $datos->tabla . ".csv", "w")) !== false) {
                    foreach ($csv as $arreglo) {
                        if ($arreglo[0] != $num) {
                            fputcsv($archivo2, array($arreglo[0], $arreglo[1], $arreglo[2]));
                        }
                    }
                    fclose($archivo2);
                    echo 2;
                } else {
                    echo 1;
                }
            } else {
                echo 1;
            }
        } else {
            echo 0;
        }
        $conexion->cerrar();
    }

    // Funcion para agregar datos del cliente en la base de datos
    public function agregarInformacion($num, $nom, $fecha)
    {
        session_start();
        $correo   = $_SESSION["usuario"];
        $consulta = "SELECT tabla FROM usuarios WHERE correo = '$correo'";
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->consulta($consulta);
        $result = $conexion->resultadoConsulta();
        $filas  = $conexion->resultadoFilas();
        $csv    = array();
        if ($filas > 0) {
            $datos = $result->fetch_object();
            if (($archivo1 = fopen("Tablas/" . $datos->tabla . ".csv", "r")) !== false) {
                while (($fila = fgetcsv($archivo1, 0, ",")) !== false) {
                    if (count($fila) > 0) {
                        array_push($csv, array($fila[0], $fila[1], $fila[2]));
                    }
                }
                if (($archivo2 = fopen("Tablas/" . $datos->tabla . ".csv", "w")) !== false) {
                    array_push($csv, array($num, $nom, $fecha));
                    foreach ($csv as $arreglo) {
                        fputcsv($archivo2, array($arreglo[0], $arreglo[1], $arreglo[2]));
                    }
                    fclose($archivo2);
                    echo 2;
                } else {
                    echo 1;
                }
            } else {
                echo 1;
            }
        } else {
            echo 0;
        }
        $conexion->cerrar();
    }

    // Funcion para cargar tabla con datos de los clientes de la base de datos
    public function cargarTablaBusqueda()
    {
        session_start();
        $correo   = $_SESSION["usuario"];
        $consulta = "SELECT tabla FROM usuarios WHERE correo = '$correo'";
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->consulta($consulta);
        $result = $conexion->resultadoConsulta();
        $filas  = $conexion->resultadoFilas();
        $csv    = array();
        if ($filas > 0) {
            $datos = $result->fetch_object();
            if (($archivo = fopen("Tablas/" . $datos->tabla . ".csv", "r")) !== false) {
                while (($fila = fgetcsv($archivo, 0, ",")) !== false) {
                    array_push($csv, array($fila[0], $fila[1], $fila[2], date("Y-m-d") >= $fila[2] ? "Vencido" : "Pago"));
                }
                if (!empty($csv)) {
                    $codigo = json_encode($csv);
                    echo $codigo;
                } else {
                    echo 2;
                }
            } else {
                echo 1;
            }
        } else {
            echo 0;
        }
        $conexion->cerrar();
    }
}
