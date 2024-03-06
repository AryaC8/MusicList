<?php

/* 
* El archivo "headerInicio.php" es el que contiene el código necesario para la cabecera.
*/
require_once("../Parts/headerInicio.php");

?>

      <div class="container text-center col-3 posicion">
        <div class="row align-items-center">
            <div class="text-center">     
                <h3>Recuperar Contraseña</h3>
            </div>

             <?php
              /* 
              * Se incluye el archivo `recuperarClaver.php`, este archivo controla los datos de la contraseña.
              */
              require_once("../Controller/recuperarClaveController.php");             
             ?>

        <!-- Formulario de para recuperar la contraseña-->
         <form action="recuperarClave.php" method="POST" id="formulario">
            <div class="form-floating mb-3" id="email">
                <input type="email" class="form-control" name="email" placeholder="name@example.com">
                <label for="email">Email</label>
              </div>
            <div class="form-floating" id="DNI">
                <input type="text" class="form-control" name="DNI" placeholder="DNI">
                <label for="DNI">DNI</label>
            </div>         
            <div class="text-center margen-btn" id = "recuperar">
                <input type="submit" class="btn btn-primary" name="botonRecuperarClave" id = "recuperarBoton" value="Recuperar"><br>
            </div>           
         </form>

         <div class="text-center margen-btn d-none" id = "divIniciar">
                <a href="inicioSesion.php" class="link-success" name="iniciar" id = "linkIniciar">Volver a Iniciar Sesión</a><br>
         </div>

        </div>  
      </div>  


<?php

/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
require_once("../Parts/footer.php");

?>