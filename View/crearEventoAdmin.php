<?php

/* 
* Se incluye el archivo `Sesiones.php` que es un archivo de clase que contiene funciones para administrar sesiones en PHP.
* El archivo "headerHome.php" es el que contiene el código necesario para la cabecera.
*/
  require_once("../Parts/headerHome.php");  
  require_once("../Clases/Sesiones.php");
    

  $sesion = new Sesion();


/* 
* Dependiendo de si existe la variable de sesión "rol" y del valor que tenga, el usuario tendrá permiso para
* visualizar esta página o no. Solamente tendrá permiso el usuario con rol de administrador.
*/
  if (isset($_SESSION["rol"]) && ($_SESSION["rol"] != "admin")){

    header("location:../View/sinPermiso.php");

  }
?>


<!-- Formulario que contiene los datos necesarios para registrar un nuevo evento en la base de datos. -->
<div class="container mt-5">  
    <div class="">     
        <h3>Crear Evento</h3>
     </div>  
          <?php
          /* 
          * Se incluye el archivo `eventosCOntroller.php`, este archivo controla las acciones realizadas con los eventos.
          */
            require_once("../Controller/eventosController.php");  
            crearEvento();           
          ?>

  <form action="crearEventoAdmin.php" method="POST" class="row g-3 needs-validation" novalidate>
     <div class="col-7">
       <label>Nombre del acto:</label><br>
        <input class="form-control" type="text" name="nombreActo" id="nombreActo"> 
     </div>
     <div class="col-7">
        <label>Fecha:</label><br>
        <input class="form-control" type="date" name="fecha" id="fecha"> 
    </div>
    <div class="col-7">
        <label>Hora:</label><br>
        <input class="form-control" type="time" name="hora" id="fecha"> 
    </div>
    <div class="col-7">
       <label>Direccion:</label><br>
        <input class="form-control" type="text" name="direccion" id="direccion"> 
     </div>
    <div class="col-7">
        <label>Comentario:</label><br>
        <textarea class="form-control" type="input-group-text" name="comentario" id="comentario"></textarea> 
    </div>

    <div class="container d-flex ">
      <div class="row py-4">
        <div class="col-6 text-center">
          <input type="submit" class="btn btn-primary" name="botonEvento" value="Enviar">
        </div>
        <div class="col-6 text-center">
          <input type="reset" class="btn btn-danger" name="botonCancelar" value="Cancelar">
        </div>
      </div>
    </div> 

  </form>


  

 <!-- Botón para vovler a la página anterior. -->
  <div class="col-6 text-center">
      <a class="btn btn-info" href="../View/homeAdmin.php">Volver a Inicio</a>
  </div>
</div>
 

<?php

/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
  require_once("../Parts/footer.php");      
    
?>