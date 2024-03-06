<?php

/* Incluye el archivo `conexión.php` para poder realizar la conexión con la base de datos. */
require_once("conexion.php");


//------------------------  CONSULTAS RELACIONADAS CON LOS INSTRUMENTOS   --------------------------------------

/**
 * Esta función devuelve el ID y el nombre de los intrumentos registrados en la base de datos. 
 */
function getInstrumentos() {

    $dataBase = crearConexion();

    $consultaSQL = "SELECT idInstrumento, nombre FROM instrumento";

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;
}


/**
 * Esta función devuelve la información de un instrumento determinado. 
 * 
 * @param idInstrumento El id único asignado a cada instrumento.
 */
function getInstrumento($idInstrumento) {

    $dataBase = crearConexion();

    $consultaSQL = "SELECT nombre FROM instrumento WHERE idInstrumento = '$idInstrumento'";

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;
}

?>