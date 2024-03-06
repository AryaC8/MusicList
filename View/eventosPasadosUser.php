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
      * Dependiendo de si existe la variable de sesión "rol", el usuario tendrá permiso para visualizar esta página o no. 
      */
      if (!isset($_SESSION["rol"])  ){
    
        header("location:../View/sinPermiso.php");
    
      }
    ?>

<!-- "div" que contiene la tabla en la que se visualizan los diferentes eventos que ya han sido realizados 
      (con fecha anterior a la actual) por el usuario. -->
<div class="container mt-5">  
    <div class="">     
        <h3>Actos realizados</h3>
     </div>          
  
<table class="table ">
    <tr class="bg-success">
        <th>Nombre del acto</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Dirección</th>
        
    </tr> 

    <?php      
       mostrarEventosPasadosUser();
    ?>    
</table>
</div>


<!-- "div" que contiene la tabla en la que se visualizan los diferentes eventos a los que 
se ha confirmado la asistencia por parte del usuario. -->
<div class="container mt-5">  
    <div class="">     
        <h3>Actos confirmados</h3>
     </div>          
  
<table class="table ">
    <tr class="bg-info">
        <th>Nombre del acto</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Dirección</th>
        
    </tr> 

    <?php      
       mostrarEventosConfirmadosUser();
    ?>    
</table>
</div>


<?php

      /* 
      * Dependiendo de si existe la variable de sesión "rol" y del valor que tenga, el usuario visualizará botón 
      * u otro. 
      */
if (isset($_SESSION["rol"]) && ($_SESSION["rol"] == "user")){
    
  echo "<div class = 'container mt-5'>
          <div class= 'd-flex justify-content-start'>
            <div id = 'botonVolver' class='text-center'>
              <a class='btn btn-info' href='../View/homeUser.php'>Volver al inicio </a>
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