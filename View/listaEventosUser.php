
<?php

/* Estas líneas de código incluyen el archivo PHP necesario para que el script funcione
* correctamente. `eventosController.php` es un archivo controlador que contiene las funciones relacionadas con 
* los eventos.
*/
require_once("../Controller/eventosController.php");  


$sesion = new Sesion();

  /* 
  * Dependiendo de si existe la variable de sesión "rol" y del valor que tenga, el usuario visualizará una 
  * cabecera u otra.
  */
  if (isset($_SESSION["rol"]) && ($_SESSION["rol"] == "user")){
    
    require_once("../Parts/headerUsers.php");

  }else if (isset($_SESSION["rol"]) && ($_SESSION["rol"] == "admin")){
    
    require_once("../Parts/headerHome.php");

  }

      /*
      * Se incluye el archivo `asistenciaController.php` que es el archivo que contiene las diferentes funciones
      * relacionadas con la asistencia.
      */  
      require_once("../Controller/asistenciaController.php"); 
      
      
     
    ?>

<!-- "div" que contiene la tabla en la que se visualizan los diferentes eventos programados y a los que se debe
    confirmar la asistencia por parte del usuario. -->
<div class="container mt-5">  
    <div class="">     
        <h3>Actos</h3>
     </div>          
  
<table class="table">
    <tr class="bg-info text-center">
        <th>Acto</th>
        <th>Nombre del acto</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Dirección</th>
        <th>Comentario</th>
        <th>Confirmar asistencia</th>
    </tr> 

    <?php 
      mostrarEventosUser();
    ?> 
    </table>
        </div>

  <?php

    /*
    * Si el usuario indica que SÍ asiste al acto, se guarda su asistencia.
    */
    if(isset($_GET["Si"])){						
                    
            
       confirmarAsistenciaUser();             
                            
    /*
    * Si el usuario indica que NO asiste al acto, se borra el registro de asistencia.
    */                       
    }else if(isset($_GET["No"])){

      borrarAsistenciaUser();
  
  }

/* 
* Dependiendo de si existe la variable de sesión "rol" y del valor que tenga, el usuario visualizará botón 
* u otro. 
*/ 
if (isset($_SESSION["rol"]) && ($_SESSION["rol"] == "user")){
    
  echo "<div class = 'container mt-5'>
          <div class= 'd-flex justify-content-start'>
            <div id = 'botonVolver' class='text-center'>
              <a class='btn btn-info' href='../View/homeUser.php'>Volver inicio </a>
            </div>
          </div>
        </div>";

  }else if (isset($_SESSION["rol"]) && ($_SESSION["rol"] == "admin")){
  echo "<div class = 'container mt-5'>
          <div class= 'd-flex justify-content-start'>
            <div id = 'botonVolver' class='text-center'>
              <a class='btn btn-info' href='../View/homeAdmin.php'>Volver al inicio </a>
            </div>
          </div>
        </div>";

  }




/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
  require_once("../Parts/footer.php");  
?>

 
