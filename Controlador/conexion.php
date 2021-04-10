<?php

class Conexion {

    private $mysql; //Variable para guardar atributos del mysql
    private $resultado; //Variable para guardar resultado del query
    private $filas; //Variable para guardar cantidad de filas afectadas en el query
    private $server = "localhost"; //Variable para guardar nombre del servidor
    private $user = "root"; //Variable para guardar nombre del usuario de servidor
    private $pass = ""; //Variable para guardar contraseña del servidor
    private $database = "admingym"; //Variable para guardar base de datos del servidor

    function abrir() {
        $this->mysql = new mysqli($this->server, $this->user, $this->pass, $this->database);
        if($this->mysql->connect_error){
            return 0;
        } else{
            return 1;
        }
    }

    // Funcion para realizar query en la base de datos 
    function consulta($cons) {
        $resultado = $this->mysql->prepare($cons); // Prepara la consulta para evitar caracteres desconocidos
        if ($resultado != FALSE) {
            $this->resultado = $this->mysql->query($cons) or trigger_error("Error en la consulta: " . mysqli_error($this->mysql), E_USER_ERROR);
            $this->filas = $this->mysql->affected_rows;
        } else{
            print "<script language='javascript'> alert('Error en la conexion.'); </script>";
        }
    }

    // Funcion para obtener resultado del query
    function resultadoConsulta() {
        return $this->resultado;
    }

    // Funcion para obtener filas afectadas por el query
    function resultadoFilas() {
        return $this->filas;
    }

    // Funcion para cerrar conexion con la base de datos
    function cerrar() {
        $this->mysql->close();
    }

}
