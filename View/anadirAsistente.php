<?php

/* Estas líneas de código incluyen los archivos PHP necesarios para que el script funcione
* correctamente. `eventosController.php`, `asistenciaController.php` y `registroUsuarioController.php`
* son archivos controladores que contienen las funciones relacionadas con 
* los eventos, la asistencia y el registro de usuarios.
* El archivo "headerHome.php" es el que contiene el código necesario para la cabecera. 
*/
require_once("../Parts/headerHome.php");  
require_once("../Controller/eventosController.php");  
require_once("../Controller/asistenciaController.php");
require_once("../Controller/registroUsuarioController.php");   


$sesion = new Sesion();


/* 
* Dependiendo de si existe la variable de sesión "rol" y del valor que tenga, el usuario tendrá permiso para
* visualizar esta página o no. Solamente tendrá permiso el usuario con rol de administrador.
*/
    if (!isset($_SESSION["rol"]) || isset($_SESSION["rol"]) && ($_SESSION["rol"] != "admin")){

      header("location:../View/sinPermiso.php");

    }


/* 
* Si existe la variable "GET" "anadir", se extrae el evento correspondiente a ese ID. 
*/
    if(isset($_GET["anadir"])){						
                    
    $anadir = mysqli_fetch_assoc(getEvento($_GET["anadir"]));           
    }


/* 
* Si existe el evento con esa ID, entonces se muestra los datos del evento, así como los instrumentos disponibles 
* en la base de datos y, al selecionar un instrumento determinado, muestra los usuarios que están registrados en 
* la base de datos y tienen ese instrumento asignado.
*/

if(isset($anadir)) {   
    ?>  
    <div class="container mt-5" >
        <div class="row">
          <form action="../View/anadirAsistente.php" method="POST">
            <p><label> Acto: </label>
                <input class="form-control" type ="text" name="idActo" value = '<?php echo $anadir["nombreActo"]; ?>' aria-label="Disabled input example" disabled></p>
                <input type ="hidden" name ="idActoNum" value = '<?php echo $anadir["idActo"]; ?>'></p>
            <p><label> Instrumento: </label>				
            <select class="form-select" id="instrumentos" name= "instrumentos" required>
                <option selected disabled value="">Instrumento</option>
                    <?php $instrumentos = mysqli_fetch_assoc(getInstrumentos());   
                        selectInstrumentos($instrumentos['idInstrumento']); ?>  
            </select></p>            
            <p><label> Nombre completo: </label>             			
             <select id = "nombreCompleto" class="form-select" id="nombreCompleto" name= "nombreCompleto" disabled>
                 <option value="">Asistente</option>
            </select></p>													  
               
                        
    <?php     

        
/* 
* Si existe la variable "anadir", se se muestra el botón para mandar la información del formulario. 
*/
    if(isset($_GET["anadir"])){
            
        echo "<div class = 'container position-absolute'>
                <div class= 'position-absolute top-50 start-50'>
                    <input id='boton1' class='btn btn-success' type ='submit' name ='Añadir' value ='Añadir'>
                </div>
            </div>";   
    }

    echo "</form>"; 


}
    echo  "</div>
    </div>";



/*
* Botón para vovler a la página anterior.
*/
    echo "<div class = 'container position-relative my-auto'>
            <div class = 'justify-content-center'>          
                <div id = 'botonVolver' class='text-center'>
                    <a class='btn btn-info' href='../View/validarAsistenciaAdmin.php'>Volver</a>
                </div>            
            </div>
        </div>";       


    ?> 



 <!-- Importa los archivos necesarios (jquery y `anadirAsistente.js`)para hacer funcionar el script de jquery y de js. -->
    <script src = https://code.jquery.com/jquery-3.6.1.min.js></script>
 
    <script type = "text/javascript" src = "../Public/js/anadirAsistente.js"></script> 
 



<?php 

/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
    require_once("../Parts/footer.php");  
?>





