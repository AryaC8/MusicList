<?php 

/* La clase Acto es un constructor que inicializa las propiedades de un evento o actividad. */
class Acto {

    private $nombreActo;
    private $fecha;
    private $hora;
    private $direccion;
    private $comentario;

   /**
     * Esta es una función constructora que inicializa las propiedades de un objeto.
     * 
     * @param nombreActo Este parámetro representa el nombre de un evento o actividad.
     * @param fecha Representa la fecha del evento.
     * @param hora Representa la hora del evento.
     * @param direccion Este parámetro representa la dirección o ubicación de un evento o actividad.
     * Podría ser una dirección física o una descripción de la ubicación.
     * @param comentario Este parámetro es una cadena que representa cualquier comentario o nota
     * adicional relacionada con el evento. Se puede utilizar para proporcionar más información sobre
     * el evento o para comunicar cualquier instrucción o requisito especial a los asistentes.
     */
    function __construct($nombreActo, $fecha, $hora, $direccion, $comentario){

        
        $this-> nombreActo = $nombreActo;
        $this-> fecha = $fecha;
        $this-> hora = $hora;
        $this-> direccion = $direccion;
        $this-> comentario = $comentario;

    }
    
    
    /**
     * Este es un método mágico en PHP que permite acceder a propiedades de objetos que no son visibles
     * o accesibles desde fuera del objeto.
     * 
     * @param propiedad una cadena que representa el nombre de la propiedad a la que se accede.
     * 
     * @return El valor de la propiedad solicitada si existe en el objeto actual.
     */
    function __get($propiedad){

        if (property_exists($this, $propiedad)) {
            return $this->$propiedad;
        }
        
    }

    /**
     * Este es un método mágico en PHP que establece el valor de una propiedad si existe en el objeto.
     * 
     * @param propiedad El nombre de la propiedad para la que queremos establecer un valor.
     * @param valor valor es una variable que representa el valor que se le asignará a la propiedad.
     */
    function __set($propiedad , $valor){

        if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        }
        
    }

}
?>