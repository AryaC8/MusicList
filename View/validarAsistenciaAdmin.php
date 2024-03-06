<?php

/* Estas líneas de código incluyen los archivos PHP necesarios para que el script funcione
* correctamente. `eventosController.php`, `asistenciaController.php` y `accesoController.php`
* son archivos controladores que contienen las funciones relacionadas con 
* los eventos, la asistencia y el acceso de usuarios.
* El archivo "headerHome.php" es el que contiene el código necesario para la cabecera. 
*/
      require_once("../Parts/headerHome.php");  
      require_once("../Controller/asistenciaController.php");  
      require_once("../Controller/eventosController.php");
      require_once("../Controller/accesoController.php");
      
      $sesion = new Sesion();

      /* 
      * Dependiendo de si existe la variable de sesión "rol" y del valor que tenga, el usuario tendrá permiso para
      * visualizar esta página o no. Solamente tendrá permiso el usuario con rol de administrador.
      */
      if (!isset($_SESSION["rol"]) || isset($_SESSION["rol"]) && ($_SESSION["rol"] != "admin")){
    
        header("location:../View/sinPermiso.php");
    
      }
    ?>

<!-- "div" que contiene la tabla en la que se visualizan los diferentes eventos y la opción de validar la asistencia
de los distion usuarios que han confirmado que asistirían. -->
<div class="container mt-5">  
    <div class="">     
        <h3>Asistencia</h3>
     </div>          
  
<table class="table ">
    <tr class="bg-info">
        <th>Acto</th>
        <th>Nombre del acto</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Dirección</th>
        <th>Comentario</th>
        <th>Asistencia</th>
        <th></th>
    </tr> 
    
    <?php  
       mostrarEventoParaValidarAsistencia();
    ?>    
    
</table>
</div>


<?php

/* 
* Si el administrador elige la opción de validar la asistencia a un evento.
*/
    if(isset($_GET["Validar"])){	

        $idActo= $_GET["Validar"];
      
        $evento = getEvento($idActo);

        while($td = mysqli_fetch_assoc($evento)){

            $nombre = $td ['nombreActo'];
        }					
                    
            
       mostrarAsistenciaParaValidar($idActo);          
                            
                            
    }

 
/* 
* Dependiendo de si el administrador elija una opción u otra.
*/
if(isset($_POST["Si"]) || (isset($_POST["No"]))){	                
        
    validarAsistencia() ;  

}

/*
* Botón para vovler a la página anterior. 
*/
echo "<div class = 'container mt-5'>
<div class= 'd-flex justify-content-start'>
    <div id = 'botonVolver' class='text-center'>
        <a class='btn btn-info' href='../View/homeAdmin.php'>Volver al inicio </a>
    </div>
</div>
</div>";



// Importa los archivos necesarios (jquery y `cambiarVista.js`)para hacer funcionar el script de jquery y de js.
echo "<script src = https://code.jquery.com/jquery-3.6.1.min.js></script>";

 echo "<script type = 'text/javascript' src = '../Public/js/cambiarVista.js'></script>"; 



/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
  require_once("../Parts/footer.php");  
?>