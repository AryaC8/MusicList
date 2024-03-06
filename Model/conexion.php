<?php

/**
 * Función para crear la conexión con la base de datos.
 * Si no existe la conexión devuelve un error.
 */
function crearConexion() {

    $host = "localhost";
    $user = "root";
    $password = "";
    $baseDatos = "musiclist";

    $conexion = mysqli_connect($host, $user, $password, $baseDatos);    

    if($conexion){
        
        return $conexion;
    
    }else if (!$conexion) {
        die("Error de conexión con la base de datos: " . mysqli_connect_error());
    }
}


/**
 * Función para cerrar la conexión creada anteriormente
*/
    
function cerrarConexion($conexion) {

    mysqli_close($conexion);

}







?>