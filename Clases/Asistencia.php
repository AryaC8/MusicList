<?php 

/* La clase Asistencia define un constructor y métodos para obtener y establecer propiedades, así como
un método para mostrar información sobre un acto, asistente e instrumento. */
class Asistencia {

    private $acto;
    private $asistente;
    private $instrumento;
   


    /**
     * Esta es una función constructora que inicializa las propiedades de un objeto.
     * 
     * @param acto Este parámetro representa el evento.
     * @param asistente Este parámetro representa al asistente que interviene en el acto o evento que
     * se está construyendo. 
     * @param instrumento Este parámetro representa al instrumetno que interviene en el acto o evento que
     * se está construyendo. 
     */
    function __construct($acto, $asistente, $instrumento){

        
        $this-> acto = $acto;
        $this-> asistente = $asistente;
        $this-> instrumento = $instrumento;
        

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