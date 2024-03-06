<?php

/* Incluye el archivo "sesiones.php". */
    require_once("../Clases/sesiones.php");


/* Este código PHP está borrando los atributos "rol" y "Usuario" de la sesión y destruyendo la
    sesión. Luego, redirige al usuario a la página index.php. */
    $sesion = new Sesion();
    $sesion -> deleteAttribute("rol");
    $sesion -> deleteAttribute("Usuario");
    $sesion -> destroySession();

    header("location:../index.php");


?>