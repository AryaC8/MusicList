<?php
/* 
* El archivo "headerInicio.php" es el que contiene el código necesario para la cabecera.
*/
require_once("../Parts/headerInicio.php");
?>

<!-- "div" en el que se nuestra el aviso de que no se tiene permiso para acceder a esa página.
Se muestra un botón que redirige al formulario de inicio de sesión. -->
<div class="position-absolute top-50 start-50 translate-middle">

    <div class=" text-center">

        <h3>No tienes los permisos necesarios</h3>

        <a class="btn btn-primary" role="button" href="inicioSesion.php">Iniciar Sesión</a>

    </div>
    </div>


<?php
/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
require_once("../Parts/footer.php");
?>