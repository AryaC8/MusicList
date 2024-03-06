    <?php

      /* Estas líneas de código incluyen el archivo PHP necesario para que el script funcione
      * correctamente. `eventosController.php` es un archivo controlador que contiene las funciones relacionadas con 
      * los eventos.
      * El archivo "headerHome.php" es el que contiene el código necesario para la cabecera. 
      */
      require_once("../Parts/headerHome.php");  
      require_once("../Controller/eventosController.php");  
      

  $sesion = new Sesion();


  /* 
  * Dependiendo de si existe la variable de sesión "rol" y del valor que tenga, el usuario tendrá permiso para
  * visualizar esta página o no. Solamente tendrá permiso el usuario con rol de administrador.
  */
  if (!isset($_SESSION["rol"]) || isset($_SESSION["rol"]) && ($_SESSION["rol"] != "admin")){

    header("location:../View/sinPermiso.php");

  }
    
    ?>

<!-- "div" que contiene la tabla en la que se visualizan los diferentes eventos futuros (con fecha posterior a la actual). -->
<div class="container mt-5">  
    <div class="">     
        <h3>Actos</h3>
     </div>          
  
<table class="table ">
    <tr class="bg-info">
        <th>Acto</th>
        <th>Nombre del acto</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Dirección</th>
        <th>Comentario</th>
        <th>Asistencia prevista</th>
        <th>Acciones</th>
        <th></th>
    </tr> 

    <?php    
       mostrarEventoFuturoAdmin();
    ?>    
    
</table>
</div>

 <!-- Botón para vovler a la página anterior. -->
  <div class = 'container mt-5'>
    <div class= 'd-flex justify-content-start'>
      <div id = 'botonVolver' class='text-center'>
        <a class='btn btn-info' href='../View/homeAdmin.php'>Volver al inicio </a>
      </div>
    </div>
  </div>

  
<?php
/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
  require_once("../Parts/footer.php");  
?>

 
