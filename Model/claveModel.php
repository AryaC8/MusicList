<?php

/* Incluye el archivo `conexión.php` para poder realizar la conexión con la base de datos. */
require_once("conexion.php");


//------------------------  CONSULTAS RELACIONADAS CON LA CONTRASEÑA   --------------------------------------


/**
 * Esta función devuelve la contraseña de un usuario con un email y un DNI concretos. 
 * 
 * @param email El correo electróncio de un usuario.
 * @param DNI Documento nacional de identidad registrado de un usuario.
 */
function recuperarClave($email, $DNI){

    $ddbb = crearConexion();

    $consultaSQL = "SELECT clave FROM persona WHERE email = '$email' AND DNI = '$DNI'";

    $resultado = mysqli_query($ddbb, $consultaSQL);

    cerrarConexion($ddbb);

    return $resultado;
}



/**
 * Esta función modifica la contraseña de un usuario con un email y una contraseña anterior concretos. 
 * 
 * @param email El correo electróncio de un usuario.
 * @param clave Contraseña anteriormente registrada de un usuario.
 */
function modificarClave($clave, $email){

    $ddbb = crearConexion();

    $consultaSQL = "UPDATE persona SET clave = '$clave' WHERE email = '$email'";

    $resultado = mysqli_query($ddbb, $consultaSQL);

    cerrarConexion($ddbb);

    return $resultado;
}

?>