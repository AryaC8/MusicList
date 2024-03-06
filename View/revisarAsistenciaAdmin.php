    <?php

    /* Estas líneas de código incluyen los archivos PHP necesarios para que el script funcione
    * correctamente. `eventosController.php` y `asistenciaController.php`
    * son archivos controladores que contienen las funciones relacionadas con 
    * los eventos y la asistencia.
    * El archivo "headerHome.php" es el que contiene el código necesario para la cabecera. 
    */
      require_once("../Parts/headerHome.php");  
      require_once("../Controller/eventosController.php");  
      require_once("../Controller/asistenciaController.php");
      

      $sesion = new Sesion();


      /* 
      * Dependiendo de si existe la variable de sesión "rol" y del valor que tenga, el usuario tendrá permiso para
      * visualizar esta página o no. Solamente tendrá permiso el usuario con rol de administrador.
      */
      if (!isset($_SESSION["rol"]) || isset($_SESSION["rol"]) && ($_SESSION["rol"] != "admin")){
    
        header("location:../View/sinPermiso.php");
    
      }


      //Dependiendo de qué variable exista, se mostrará la asistencia prevista o ya la validada.
      if(isset($_GET["Asistencia"])){						
                    
        $evento = mysqli_fetch_assoc(getEvento($_GET["Asistencia"]));	

      }else if(isset($_GET["AsistenciaValidada"])){  

        $evento = mysqli_fetch_assoc(getEvento($_GET["AsistenciaValidada"]));

      }
      
    ?>


<div class="container mt-5">  

  <?php 
//Dependiendo de qué variable exista, se mostrará un título u otro.
  if(isset($_GET["Asistencia"])){	

    echo "<div class=''>     
        <h3>Asistencia prevista al acto: " .  $evento['nombreActo'] . "</h3>
     </div>";   

  }else if(isset($_GET["AsistenciaValidada"])){ 

    echo "<div class=''>     
        <h3>Asistencia confirmada al acto: " . $evento['nombreActo'] . "</h3>
     </div> ";     

  } 
      
  ?>
<!-- Tabla en la que se visualizan la asistencia a un evento en concreto. -->
  <table class="table">
    <tr class="bg-info">
        <th>Instrumento</th>
        <th>Nombre</th>
    </tr> 
    
    <?php  

if(isset($_GET["Asistencia"])){

      asistenciaPrevistaEvento($evento['idActo']); 

}else if(isset($_GET["AsistenciaValidada"])){

      asistenciaValidada($evento['idActo']);
}
 
    ?>    
  </table>


  <div>
    <?php

//Dependiendo de qué variable exista, se mostrará un botón para exportar una lista u otra.
if(isset($_GET["Asistencia"])){

  echo "<a id='boton1' class='btn btn-secondary' href='../Controller/exportarListaController.php?Asistencia&evento=" . $evento['nombreActo'] . "&idActo=" . $_GET["Asistencia"] . "'>Exportar lista a EXCEL</a>"; 

  echo "<div class = 'container mt-5'>
          <div class= 'd-flex justify-content-start'>
            <div id = 'botonVolver' class='text-center'>
              <a class='btn btn-info' href='../View/listaEventoAdmin.php'>Volver a lista de eventos </a>
            </div>
          </div>
        </div>";

}else if(isset($_GET["AsistenciaValidada"])){

  echo "<a id='boton1' class='btn btn-secondary' href='../Controller/exportarListaController.php?AsistenciaValidada&evento=" . $evento['nombreActo'] . "&idActo=" . $_GET["AsistenciaValidada"] . "'>Exportar lista a EXCEL</a>";

  echo "<div class = 'container mt-5'>
          <div class= 'd-flex justify-content-start'>
            <div id = 'botonVolver' class='text-center'>
              <a class='btn btn-info' href='../View/eventosPasados.php'>Volver a lista de eventos </a>
            </div>
          </div>
        </div>";
}

  
      ?>
  </div>

</div>


<?php

/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
  require_once("../Parts/footer.php"); 

?>

 
