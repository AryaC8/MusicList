<?php

/* Incluye el archivo `conexión.php` para poder realizar la conexión con la base de datos. */
require_once("conexion.php");




//------------------------  CONSULTAS RELACIONADAS CON LA ASISTENCIA   --------------------------------------

/**
 * Esta función guarda la asistencia prevista para un acto determinado.
 * 
 * @param idActo El ID del evento para el que se guarda.
 * @param idPersona El id único asignado a cada usuario.
 * @param idInstrumento El id único asignado a cada instrumento.
 */
function guardarAsistencia($idActo, $idPersona, $idInstrumento){

    $ddbb = crearConexion();

    $consultaSQL = "INSERT INTO asistencia (acto, asistentes, instrumentos)
                    VALUES ('$idActo', '$idPersona', '$idInstrumento')";

    $resultado = mysqli_query($ddbb, $consultaSQL);

    cerrarConexion($ddbb);

    return $resultado;

}


/**
 * Esta función guarda la asistencia validada por parte del administrador para un acto determinado.
 * 
 * @param idActo El ID del evento para el que se guarda.
 * @param idPersona El id único asignado a cada usuario.
 * @param idInstrumento El id único asignado a cada instrumento.
 */
function guardarAsistenciaValidada($idActo, $idPersona, $idInstrumento){

    $ddbb = crearConexion();

    $consultaSQL = "INSERT INTO asistenciaConfirmada (acto, asistentes, instrumentos)
                    VALUES ('$idActo', '$idPersona', '$idInstrumento')";

    $resultado = mysqli_query($ddbb, $consultaSQL);

    cerrarConexion($ddbb);

    return $resultado;

}


/**
 * Esta función modifica la asistencia prevista para un acto determinado.
 * 
 * @param idActo El ID del evento para el que se guarda.
 * @param idPersona El id único asignado a cada usuario.
 * @param idInstrumento El id único asignado a cada instrumento.
 */
function modificarAsistencia($idActo, $idPersona, $idInstrumento){

    $ddbb = crearConexion();

    $consultaSQL = "UPDATE asistencia SET asistentes = '$idPersona' 
                        AND instrumentos = '$idInstrumento' WHERE acto = '$idActo'";

    $resultado = mysqli_query($ddbb, $consultaSQL);

    cerrarConexion($ddbb);

    return $resultado;

}


/**
 * Esta función devuelve la asistencia prevista de un acto determinado. Realiza varios INNER JOIN para mostrar toda la
 * información de los registros y no los ID únicamente. Ordena los registros por instrumento.
 * 
 * @param idActo El ID del evento para el que se muestra.
 */
function getAsistencia($idActo){

    $dataBase = crearConexion();

    $consultaSQL = "SELECT instrumento.idInstrumento, instrumento.nombre AS Instrumento, asistentes, CONCAT_WS(' ',persona.nombre, persona.apellido1, persona.apellido2) AS Asistentes FROM asistencia
                    INNER JOIN acto ON asistencia.acto = acto.idActo
	                INNER JOIN persona on asistencia.asistentes = persona.idPersona 
	                INNER JOIN instrumento ON asistencia.instrumentos = instrumento.idInstrumento WHERE idActo = '$idActo' ORDER BY instrumento.idInstrumento"; 

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;
}


/**
 * Esta función devuelve la asistencia confirmada de un acto determinado. Realiza varios INNER JOIN para mostrar toda la
 * información de los registros y no los ID únicamente. Ordena los registros por instrumento.
 * 
 * @param idActo El ID del evento para el que se muestra.
 */
function getAsistenciaValidada($idActo){

    $dataBase = crearConexion();

    $consultaSQL = "SELECT instrumento.idInstrumento, instrumento.nombre AS Instrumento, asistentes, CONCAT_WS(' ',persona.nombre, persona.apellido1, persona.apellido2) AS Asistentes FROM asistenciaConfirmada
                    INNER JOIN acto ON asistenciaConfirmada.acto = acto.idActo
	                INNER JOIN persona on asistenciaConfirmada.asistentes = persona.idPersona 
	                INNER JOIN instrumento ON asistenciaConfirmada.instrumentos = instrumento.idInstrumento WHERE idActo = '$idActo' ORDER BY instrumento.idInstrumento"; 

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;
}


/**
 * Esta función devuelve el id y el nombre completo de un asistente a un evento con un instrumento determinado. 
 * 
 * @param idInstrumento El id único asignado a cada instrumento.
 */
function getAsistente($instrumento) {
		
    $dataBase = crearConexion();

    $consultaSQL = "SELECT idPersona, concat_ws(' ', persona.nombre, persona.apellido1, persona.apellido2) AS Asistente FROM persona WHERE instrumento = '$instrumento'";

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;
}


/**
 * Esta función devuelve los asistentes previstos de un evento concreto. 
 * 
 * @param idActo El ID del evento para el que se guarda.
 * @param idPersona El id único asignado a cada usuario.
 */
function comprobarAsistencia($idActo, $idPersona) {
		
    $dataBase = crearConexion();

    $consultaSQL = "SELECT asistentes FROM asistencia WHERE acto = '$idActo' AND asistentes = '$idPersona'";

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;
}


/**
 * Esta función devuelve los asistentes validados de un evento concreto. 
 * 
 * @param idActo El ID del evento para el que se guarda.
 * @param idPersona El id único asignado a cada usuario.
 */
function comprobarAsistenciaValidada($idActo, $idPersona) {
		
    $dataBase = crearConexion();

    $consultaSQL = "SELECT asistentes FROM asistenciaConfirmada WHERE acto = '$idActo' AND asistentes = '$idPersona'";

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;
}


/**
 * Esta función borra a un asistente (prevista) para un acto determinado.
 * 
 * @param idActo El ID del evento para el que se guarda.
 * @param idPersona El id único asignado a cada usuario.
 * @param idInstrumento El id único asignado a cada instrumento.
 */
function borrarAsistencia($idActo, $idPersona, $idInstrumento) {
		
    $dataBase = crearConexion();

    $consultaSQL = "DELETE FROM asistencia WHERE acto = '$idActo' AND asistentes = ' $idPersona' AND instrumentos = '$idInstrumento'";

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;
}


/**
 * Esta función borra a un asistente (asistencia que ya había sido confirmada) para un acto determinado.
 * 
 * @param idActo El ID del evento para el que se guarda.
 * @param idPersona El id único asignado a cada usuario.
 * @param idInstrumento El id único asignado a cada instrumento.
 */
function borrarAsistenciaValidada($idActo, $idPersona, $idInstrumento) {
		
    $dataBase = crearConexion();

    $consultaSQL = "DELETE FROM asistenciaconfirmada WHERE acto = '$idActo' AND asistentes = ' $idPersona' AND instrumentos = '$idInstrumento'";

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;
}
?>