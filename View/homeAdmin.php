<?php

/* 
* Se incluye el archivo `accesoController.php`, este archivo controla los datos de inicio de sesión.
* El archivo "headerHome.php" es el que contiene el código necesario para la cabecera.
*/
    require_once("../Parts/headerHome.php");  
    require_once("../Controller/accesoController.php");

   

    $sesion = new Sesion();


    /* 
    * Dependiendo de si existe la variable de sesión "rol" y del valor que tenga, el usuario tendrá permiso para
    * visualizar esta página o no. Solamente tendrá permiso el usuario con rol de administrador.
    */
    if (!isset($_SESSION["rol"]) || isset($_SESSION["rol"]) && ($_SESSION["rol"] != "admin")){

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


<!-- Bloque en formato acordeón que muestra las diferentes "cards" donde están las secciones a las que puede acceder el 
usuario administrador. -->
<div class="mt-5 container accordion accordion" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="acordeon accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
        Parte administrador
      </button>
    </h2>
    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" >

      <div class="container d-flex flex-row justify-content-center alig-items-center">
        <nav class="row py-4">
          <div class="card py-2 mx-4 my-4" style="width:16rem;">
            <img src="../Public/img/calendario.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Crear eventos</h5>
              <p class="card-text">Crea eventos futuros.</p>
              <a href="../View/crearEventoAdmin.php" class="btn btn-primary">Crear</a>
            </div>
          </div>

          <div class="card py-2 mx-4 my-4" style="width:16rem;">
            <img src="../Public/img/calendario.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Eventos programados</h5>
              <p class="card-text">Consulta y modifica eventos ya creados.</p>
              <a href="../View/listaEventoAdmin.php" class="btn btn-primary">Consultar</a>
            </div>
          </div>

          <div class="card py-4 mx-4 my-4" style="width:16rem;">
            <img src="../Public/img/list.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Pasa lista</h5>
              <p class="card-text">Obtén la lista de participantes de cada evento y valida su asistencia.</p>
              <a href="../View/validarAsistenciaAdmin.php" class="btn btn-primary">Empezar</a>
            </div>
          </div>

          <div class="card py-4 mx-4 my-4" style="width:16rem;">
            <img src="../Public/img/instrumentos.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Actos realizados</h5>
              <p class="card-text">Revisa las listas de actos pasados.</p>
              <a href="../View/eventosPasados.php" class="btn btn-primary">Revisar</a>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>


<!-- Bloque en formato acordeón que muestra las diferentes "cards" donde están las secciones a las que puede acceder el 
usuario administrador pero como si fuera usuario. Para poder realizar las diferentes gestiones relacionadas con el rol de
usuario. -->
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="acordeon accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
       Parte usuario
      </button>
    </h2>
    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
      
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
  </div>
</div>



<?php
/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
  require_once("../Parts/footer.php");  
?>