<?php

/* Incluye el archivo `conexión.php` para poder realizar la conexión con la base de datos. */
require_once("conexion.php");



//------------------------  CONSULTAS RELACIONADAS CON LOS EVENTOS   --------------------------------------

/**
 * Esta función guarda un evento en la base de datos.
 * 
 * @param nombreActo El nombre del evento que se guarda.
 * @param fecha La fecha de la realización de ese evento.
 * @param hora La hora de la realización de ese evento.
 * @param direccion La dirección en la que se llevará a cabo la realización del evento.
 * @param comentario Comentario que desee añadir el administrador para completar la información de este evento.
 */
function anadirEvento($nombreActo, $fecha, $hora, $direccion, $comentario) {

    $ddbb = crearConexion();

    $consultaSQL = "INSERT INTO acto (nombreActo, fecha, hora, direccion, comentario)
                    VALUES ('$nombreActo', '$fecha', '$hora', '$direccion', '$comentario')";

    $resultado = mysqli_query($ddbb, $consultaSQL);

    cerrarConexion($ddbb);

    return $resultado;
}


/**
 * Esta función devuelve la información de un acto determinado. 
 * 
 * @param idActo El ID del evento para el que se muestra.
 */
function getEvento($idActo) {

    $dataBase = crearConexion();

    $consultaSQL = "SELECT idActo, nombreActo, fecha, hora, direccion, comentario FROM acto WHERE idActo = $idActo";

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;
}


/**
 * Esta función modifica un evento ya registrado en la base de datos.
 * 
 * @param nombreActo El nombre del evento que se guarda.
 * @param fecha La fecha de la realización de ese evento.
 * @param hora La hora de la realización de ese evento.
 * @param direccion La dirección en la que se llevará a cabo la realización del evento.
 * @param comentario Comentario que desee añadir el administrador para completar la información de este evento.
 */
function modificarEvento($idActo, $nombreActo, $fecha, $hora, $direccion, $comentario){

    $dataBase = crearConexion();

    $consultaSQL = "UPDATE acto SET nombreActo = '$nombreActo', fecha = '$fecha', hora = '$hora', direccion = '$direccion', comentario = '$comentario' WHERE idActo = '$idActo'";

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;


}


/**
 * Esta función elimina el registro de un acto determinado. 
 * 
 * @param idActo El ID del evento para el que se muestra.
 */
function eliminarEvento($idActo){

    $dataBase = crearConexion();

    $consultaSQL = "DELETE FROM acto WHERE idActo = $idActo";

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;

}


/**
 * Esta función devuelve la información de los actos con una fecha anterior a la actual.
 * Es decir, muestra los eventos que ya se han ocurrido. 
 */
function getEventosPasados(){

    $ddbb = crearConexion();

    $consultaSQL = "SELECT * FROM acto WHERE concat_ws(' ', acto.fecha, acto.hora) < now()";

    $resultado = mysqli_query($ddbb, $consultaSQL);

    cerrarConexion($ddbb);

    return $resultado;

}


/**
 * Esta función devuelve la información de los actos con una fecha posterior a la actual.
 * Es decir, muestra los eventos que aún no han ocurrido. 
 */
function getEventosFuturos(){

    $ddbb = crearConexion();

    $consultaSQL = "SELECT * FROM acto WHERE concat_ws(' ', acto.fecha, acto.hora) > now()";

    $resultado = mysqli_query($ddbb, $consultaSQL);

    cerrarConexion($ddbb);

    return $resultado;

}


/**
 * Esta función muestra los actos realizados de un usuario determinado. 
 * 
 * @param idUser El id único asignado a cada usuario.
 */
function getEventosPasadosUser($idUser){

     $ddbb = crearConexion();

     $consultaSQL = "SELECT acto.nombreActo, acto.fecha, acto.hora, acto.direccion FROM asistenciaConfirmada 
     INNER JOIN acto ON asistenciaConfirmada.acto = acto.idActo
     INNER JOIN persona on asistenciaConfirmada.asistentes = persona.idPersona WHERE idPersona = '$idUser' and concat_ws(' ', acto.fecha, acto.hora) < now()";

     $resultado = mysqli_query($ddbb, $consultaSQL);

     cerrarConexion($ddbb);

     return $resultado;
}


/**
 * Esta función muestra los actos futuros de un usuario determinado. 
 * 
 * @param idUser El id único asignado a cada usuario.
 */
function getEventosFuturosUser($idUser){

    $ddbb = crearConexion();

    $consultaSQL = "SELECT acto.nombreActo, acto.fecha, acto.hora, acto.direccion FROM asistencia 
    INNER JOIN acto ON asistencia.acto = acto.idActo
    INNER JOIN persona on asistencia.asistentes = persona.idPersona WHERE idPersona = '$idUser' and concat_ws(' ', acto.fecha, acto.hora) > now()";

    $resultado = mysqli_query($ddbb, $consultaSQL);

    cerrarConexion($ddbb);

    return $resultado;

}


?>