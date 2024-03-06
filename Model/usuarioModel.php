<?php

 /* Incluye el archivo `conexión.php` para poder realizar la conexión con la base de datos. */
 require_once("conexion.php");


 //------------------------  CONSULTAS RELACIONADAS CON EL USUARIO   --------------------------------------

 /**
 * Esta función guarda un usuario en la base de datos.
 * 
 * @param nombre El nombre del usuario que se guarda.
 * @param apellido1 El primer apellido del usuario que se guarda.
 * @param apellido1 El segundo apellido del usuario que se guarda. (Dato no obligatorio)
 * @param DNI Documento nacional de identidad de un usuario.
 * @param movil Número de teléfono móvil.
 * @param email El correo electróncio del usuario.
 * @param idInstrumento El id único asignado a cada instrumento.
 * @param claveCodificada Contraseña ya codificada.
 * @param enabled Tipo de rol (usuario o amdinistrador) del usaurio.
 * 
 */
 function anadirUsuario($nombre, $apellido1, $apellido2, $DNI, $movil, $email, $instrumento, $claveCodificada, $enabled) {

    $ddbb = crearConexion();

    $consultaSQL = "INSERT INTO persona (nombre, apellido1, apellido2, DNI, movil, email, instrumento, clave, enabled)
                    VALUES ('$nombre', '$apellido1', '$apellido2', '$DNI', '$movil', '$email', '$instrumento', '$claveCodificada', '$enabled')";

    $resultado = mysqli_query($ddbb, $consultaSQL);

    cerrarConexion($ddbb);

    return $resultado;
 }


 /**
 * Esta función extrae toda la información de un usuario con un email y una contraseña determinados. 
 * 
 * @param email El correo electróncio de un usuario.
 * @param clave Contraseña de un usuario.
 * 
 */
 function validarUsuario($email, $claveCodificada){

    $ddbb = crearConexion();

    $consultaSQL = "SELECT * FROM persona WHERE email = '$email' AND clave = '$claveCodificada'";

    $resultado = mysqli_query($ddbb, $consultaSQL);

    cerrarConexion($ddbb);

    return $resultado;
 }


 /**
 * Esta función selecciona el email, el nombre y el registro de "enabled" de un usuario con un email concreto.
 * Después, dependiendo del valor "enabled" que tiene el usuario devuelve el tipo de rol correspondiente. 
 * 
 * @param email El correo electróncio de un usuario.
 * 
 */
 function tipoUsuario($email){

    $dataBase = crearConexion();
    
    //Con esta consulta se devuelven los datos de tabla user donde el nombre
    //y el email coincidan con los introducidos 

        $consultaSQL = "SELECT nombre, email, enabled FROM persona 
                            WHERE email = '$email'";

        $resultado = mysqli_query($dataBase, $consultaSQL);

        cerrarConexion($dataBase);

        $listar =  mysqli_fetch_assoc($resultado);
    

        //Dependiendo de cada usuario, tendrá unos permisos u otros

        if($listar){	
            if ($listar["enabled"] == 1) {
                return "admin";
            }else if($listar["enabled"] == 0){
                return "user";
            }
        }else{
            return "no registrado";
        }
        		
 }	


 /**
 * Esta función devuelve el ID, el nombre completo y el instrumento de un usuario con un email determinado. 
 * 
 * @param email El correo electróncio de un usuario.
 * 
 */
 function getUsuario($email) {
		
    $dataBase = crearConexion();

    $consultaSQL = "SELECT idPersona, concat_ws(' ', persona.nombre, persona.apellido1) AS Usuario, instrumento FROM persona WHERE email = '$email'";

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;
 }


 /**
 * Esta función devuelve toda la información de un usuario con un email determinado. 
 * 
 * @param email El correo electróncio de un usuario.
 * 
 */
 function getUsuarioCompleto($email) {
		
    $dataBase = crearConexion();

    $consultaSQL = "SELECT * FROM persona WHERE email = '$email'";

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;
 }


 /**
 * Esta función devuelve toda la información de un usuario con un ID determinado. 
 * 
 * @param idPersona El id único asignado a cada usuario.
 * 
 */
 function getUserConId ($idPersona){

    $dataBase = crearConexion();

    $consultaSQL = "SELECT * FROM persona WHERE idPersona = '$idPersona'";

    $resultado = mysqli_query($dataBase, $consultaSQL);

    cerrarConexion($dataBase);

    return $resultado;

 }


 /**
 * Esta función modifica los datos de un usuario con ID determinado en la base de datos.
 * 
 * @param nombre El nombre del usuario que se guarda.
 * @param apellido1 El primer apellido del usuario que se guarda.
 * @param apellido1 El segundo apellido del usuario que se guarda. (Dato no obligatorio)
 * @param DNI Documento nacional de identidad de un usuario.
 * @param movil Número de teléfono móvil.
 * @param email El correo electróncio del usuario.
 * @param idInstrumento El id único asignado a cada instrumento.
 * @param idPersona El id único asignado a cada usuario.
 * 
 */
 function modificarUsuario($nombre, $apellido1, $apellido2, $DNI, $movil, $instrumento, $idPersona) {

    $ddbb = crearConexion();

    $consultaSQL = "UPDATE persona SET nombre = '$nombre', apellido1 = '$apellido1', apellido2 = '$apellido2', DNI = '$DNI', movil = '$movil', 
                    instrumento = '$instrumento' WHERE idPersona = '$idPersona'";

    $resultado = mysqli_query($ddbb, $consultaSQL);

    cerrarConexion($ddbb);

    return $resultado;
 }


 /**
 * Esta función modifica el email de un usuario con un ID determinado. 
 * 
 * @param emailNuevo El correo electróncio nuevo de un usuario.
 * @param idPersona El id único asignado a cada usuario.
 * 
 */
 function modificarEmail($emailNuevo, $idPersona){

    $ddbb = crearConexion();

    $consultaSQL = "UPDATE persona SET email = '$emailNuevo' WHERE idPersona = '$idPersona'";

    $resultado = mysqli_query($ddbb, $consultaSQL);

    cerrarConexion($ddbb);

    return $resultado;
 }


?>