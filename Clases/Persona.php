<?php 

/* La clase define una Persona y un Tipo de Usuario con propiedades y métodos para establecer y obtener
valores y confirmar el registro del usuario. */
class Persona {

    private $nombre;
    private $apellido1;
    private $apellido2;
    private $DNI;
    private $movil;
    private $email;
    private $instrumento;
    private $claveCodificada;
    

    /**
     * Esta es una función constructora que inicializa las propiedades del objeto con parámetros
     * dados.
     * 
     * @param nombre El primer nombre de una persona.
     * @param apellido1 El primer apellido de una persona.
     * @param apellido2 El segundo apellido o apellido de una persona. (No todos los usuarios tendrán este segundo apellido).
     * @param DNI "Documento Nacional de Identidad", que es un número de identificación
     * único asignado a personas en España.
     * @param movil Es una variable que almacena el número de teléfono móvil de una persona.
     * @param email El parámetro de correo electrónico es una cadena que representa la dirección de
     * correo electrónico de una persona. Se usa como una propiedad en la función constructora para
     * crear un objeto con la dirección de correo electrónico dada.
     * @param instrumento Este parámetro representa el instrumento musical que toca la persona. 
     * @param claveCodificada Este parámetro representa una contraseña codificada por motivos de seguridad. 
     * El método de codificación se especifica en otro archivo: password_hash(string $password, PASSWORD_DEFAULT). 
     */
    function __construct($nombre, $apellido1, $apellido2, $DNI, $movil, $email, $instrumento, $claveCodificada){

        
        $this-> nombre = $nombre;
        $this-> apellido1 = $apellido1;
        $this-> apellido2 = $apellido2;
        $this-> DNI = $DNI;
        $this-> movil = $movil;
        $this-> email = $email;
        $this-> instrumento = $instrumento;
        $this-> claveCodificada = $claveCodificada;

    }
    

   /**
     * Este es un método mágico en PHP que permite acceder a propiedades de objetos que no son visibles
     * o accesibles desde fuera del objeto.
     * 
     * @param propiedad una cadena que representa el nombre de la propiedad a la que se accede. Esta
     * función es un método mágico en PHP que se llama cuando se accede a una propiedad inaccesible
     * usando el operador de flecha (->propiedad). Comprueba si la propiedad existe en el objeto
     * actual y devuelve su valor si existe.
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


    /**
     * La función confirma si un usuario está registrado y muestra un mensaje de éxito o error según
     * corresponda.
     * 
     * @param usuario El parámetro "usuario" es una variable que representa un objeto de usuario o
     * datos cuya existencia se está comprobando. La función "confirmarUser" comprueba si la variable
     * "usuario" está configurada (es decir, no es nula) y muestra un mensaje de éxito con un enlace
     * para iniciar sesión si está configurada
     */
    function confirmarUser($usuario){

        if(isset($usuario)){
          
          echo "<div class='alert alert-success text-center' role='alert'> USUARIO REGISTRADO </div>";
          echo "<a class='badge badge-primary' href='inicioSeson.php' role='button'>Iniciar Sesión</a><br>";
  
        }else{
  
            echo "<div class='alert alert-danger text-center'> USUARIO NO REGISTRADO </div>";
        }
      }
}



/* La clase TipoUser extiende la clase Persona y agrega una propiedad para permisos(distiontos roles). */
 class TipoUser extends Persona{

    protected $enabled;

    function setPermiso($permiso){
        $this-> enabled= $permiso;
    }

     function getPermiso(){
         return $this->enabled;
     }
 }


    
?>