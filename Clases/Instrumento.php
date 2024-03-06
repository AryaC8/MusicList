<?php 

/* La clase "Instrumento" define un instrumento musical con propiedades como id, nombre y familia, e
incluye métodos mágicos para acceder y establecer esas propiedades. */

class Instrumento {

    private $idInstrumento;
    private $nombre;
    private $familia;

    /**
     * Esta es una función constructora que inicializa las propiedades de un objeto con los parámetros
     * provistos.
     * 
     * @param id El identificador único del instrumento.
     * @param nombre Este parámetro representa el nombre del instrumento.
     * @param familia El parámetro "familia" es una variable que representa la familia del instrumento
     * musical. Podría ser cuerda, percusión, metal y madera.
     */
    function __construct($id, $nombre, $familia ){

        $this-> idInstrumento = $id;
        $this-> nombre = $nombre;
        $this-> familia = $familia;
    }
    

     
    /**
 * Este es un método mágico en PHP que permite acceder a propiedades de objetos que no son visibles o
 * accesibles desde fuera del objeto.
 * 
 * @param propiedad "propiedad" es una variable que representa el nombre de la propiedad a la que se
 * accede en la clase. La función "__get" es un método mágico en PHP que se llama cuando se accede a
 * una propiedad inaccesible en un objeto. Esta función comprueba si la propiedad existe en el objeto y
 * devuelve su valor
 * 
 * @return Si la propiedad existe en el objeto, se devuelve el valor de esa propiedad. Si la propiedad
 * no existe, no se devuelve nada.
 */
     function __get($propiedad){

        if (property_exists($this, $propiedad)) {
            return $this->$propiedad;
        }
        
    }

    
/**
* Este es un método mágico en PHP que establece el valor de una propiedad si existe en el objeto.
* 
* @param propiedad El nombre de la propiedad que se está configurando.
* @param valor valor es una variable que representa el valor que se le asignará a la propiedad
* especificada en el parámetro .
*/
    function __set($propiedad , $valor){

        if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        }
        
    }







}





?>