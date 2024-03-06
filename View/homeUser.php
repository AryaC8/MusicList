<?php


/* 
* Se incluye el archivo `accesoController.php`, este archivo controla los datos de inicio de sesión.
* El archivo "headerUsers.php" es el que contiene el código necesario para la cabecera.
*/
require_once("../Parts/headerUsers.php"); 
require_once("../Controller/accesoController.php");


$sesion = new Sesion();

    /* 
    * Dependiendo de si existe la variable de sesión "rol" y del valor que tenga, el usuario tendrá permiso para
    * visualizar esta página o no. Solamente se tendrá permiso con rol de usuario.
    */
    if (!isset($_SESSION["rol"]) || isset($_SESSION["rol"]) && ($_SESSION["rol"] != "user")){

      header("location:../View/sinPermiso.php");

     }


      /*
      * Si existe la variable de sesión usuario, muestra en este "div" el nombre completo del usuario.
      */ 
     if(isset($_SESSION['usuario'])){

      echo "<div class='container d-flex justify-content-end mt-3'>
              <div class = ' w-25 tarjeta card text-center'>
                <div class = 'card-body'>  
                  <h6>" . $_SESSION['usuario'] . "</h6> 
                </div>
              </div>
          </div>";
  }   
?>


<!-- Bloque que muestra las diferentes "cards" donde están las secciones a las que puede acceder el 
usuario para poder realizar las diferentes gestiones de asistencia y visualizar los actos. -->
<div class="container d-flex flex-row justify-content-center alig-items-center">
<nav class="row py-4">

<div class="card py-4 mx-4 my-4" style="width:18rem;">
  <img src="../Public/img/list.png" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Confirma asistencia</h5>
    <p class="card-text">Confirma tu asistencia a los próximos actos.</p>
    <a href="listaEventosUser.php" class="btn btn-primary">Empezar</a>
  </div>
</div>

<div class="card py-4 mx-4 my-4" style="width:18rem;">
  <img src="../Public/img/instrumentos.png" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Actos realizados</h5>
    <p class="card-text">Revisa las listas de actos que has realizado.</p>
    <a href="eventosPasadosUser.php" class="btn btn-primary">Revisar</a>
  </div>
</div>
</nav>
</div>
</div>



<?php
/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
require_once("../Parts/footer.php"); 

?>