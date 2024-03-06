<?php 

/* La clase Session proporciona métodos para administrar atributos de sesión y destruir sesiones. */
class Sesion{

    /**
     * Esta función inicia una sesión si aún no se ha iniciado una.
     */
    function __construct(){
        
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
    * La función establece un atributo de sesión con una propiedad y un valor determinados.
    * 
    * @param propiedad Una cadena que representa el nombre de la variable de sesión que se establecerá.
    * @param valor El valor que se asignará a la variable de sesión con el nombre de propiedad
    * especificado.
    */
    function setAttribute($propiedad, $valor){

        if (session_status() === PHP_SESSION_ACTIVE && is_string($propiedad)) {
            $_SESSION[$propiedad] = $valor;
        }
       
    }

    
    /**
     * La función recupera un atributo específico de la sesión actual, si existe.
     * 
     * @param propiedad Este es un parámetro de la función "getAttribute". Es una variable de cadena
     * que representa el nombre de la variable de sesión cuyo valor debe recuperarse.
     * 
     * @return el valor de la variable de sesión con el nombre especificado en el parámetro
     * `$propiedad`. Si la sesión está activa y el parámetro es una cadena y la variable de sesión
     * existe, la función devuelve el valor de la variable de sesión. De lo contrario, devuelve nulo.
     */
    function getAttribute($propiedad){

        if (session_status() === PHP_SESSION_ACTIVE && is_string($propiedad) && isset ($_SESSION[$propiedad])) {
            return $_SESSION[$propiedad];
        }
        return null;
    }

     /**
    * La función elimina un atributo específico de la sesión PHP si existe.
    * 
    * @param propiedad  es una variable que representa el nombre del atributo/propiedad que
    * se debe eliminar de la sesión actual. Es un parámetro de tipo cadena.
    */
    function deleteAttribute($propiedad){

        if (session_status() === PHP_SESSION_ACTIVE && is_string($propiedad) && isset ($_SESSION[$propiedad])) {
            unset($_SESSION[$propiedad]);
        }
    }

    /**
    * La función destruye una sesión de PHP.
    */
    function destroySession(){
        
        session_destroy();
    }

}

?>