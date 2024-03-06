<?php 

/* 
* El archivo "headerInicio.php" es el que contiene el código necesario para la cabecera.
*/
  require_once("../Parts/headerInicio.php");
?>

      <div class="container text-center col-3 posicion">
        <div class="row align-items-center">
            <div class="text-center">     
                <h3>Iniciar sesión</h3>
             </div>

             <?php
              /* 
              * Se incluye el archivo `accesoController.php`, este archivo controla los datos de inicio de sesión.
              */
              require_once("../Controller/accesoController.php");         
             ?>

        <!-- Formulario de inicio de sesión-->
         <form action="inicioSesion.php" method="POST" class="needs-validation">
            <div class="form-floating mb-3 has-validation">
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                <label class="form-label" for="email" >Email</label>
                <div class="invalid-feedback">
                  Introduce un email válido, por favor.
                </div>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="clave" id="clave" placeholder="Password">
                <label for="clave">Contraseña</label>
            </div>
            <div class="text-end margen-btn"> 
                <a class="text-secundary" href="recuperarClave.php" role="button">Olvidé mi contraseña</label>
            </div> 
            <div class="text-center margen-btn">
                <input type="submit" class="btn btn-primary" name="botonInicioSesion" value="Inicio Sesión"><br>
            </div>
         </form>

           <div class="text-center margen-btn"> 
            <label class="text-dark">¿No tienes cuenta?</label>
            <a href="registro.php" role="button">Regístrate</a><br> 
        </div>
        </div>
      </div>  
      

<?php 
/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
  require_once("../Parts/footer.php");
?>