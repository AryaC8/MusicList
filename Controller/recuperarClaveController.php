<?php

/* Estas líneas de código incluyen los archivos `claveModel.php` y `accesoController.php` de los
directorios `Model` y `Controller` respectivamente. Esto se hace para que las funciones y clases
definidas en esos archivos puedan usarse en el script PHP actual. */
require_once("../Model/claveModel.php");
require_once("../Controller/accesoController.php");

$sesion = new Sesion();


 //--------------------------    RECUPERAR LA CONTRASEÑA   ----------------------------
 

 /* Este bloque de código está comprobando si se ha pulsado el botón "botonRecuperarClave" y si los
    campos "email" y "DNI" no están vacíos. Si ambas condiciones se cumplen, recupera los datos del
    usuario de la base de datos mediante la función "recuperarClave" y genera una contraseña
    temporal mediante la función "uniqid". Luego procesa la contraseña temporal mediante la función
    "password_hash" y actualiza la contraseña del usuario en la base de datos mediante la función
    "modificarClave". Finalmente, muestra un mensaje con la contraseña temporal para que el usuario
    la cambie lo antes posible. Si los datos del usuario no se encuentran en la base de datos,
    muestra un mensaje de error. */
    if(!empty($_POST["botonRecuperarClave"])){

        if(empty($_POST["email"]) || (empty($_POST["DNI"]))){
            echo "<div class='alert alert-danger'> CAMPOS VACÍOS </div>";

        }else{

            $email = $_POST["email"];
            $DNI = $_POST["DNI"];

            $sql= recuperarClave($email, $DNI);
          


          if($sql -> num_rows > 0){
                
                $claveTemporal = uniqid();
                $claveTempMod = password_hash($claveTemporal, PASSWORD_DEFAULT);

                modificarClave($claveTempMod, $email); 

                echo "<div class='alert alert-primary' role='alert'> Tu contraseña temporal es: " . $claveTemporal . "<br> CÁMBIELA CUANTO ANTES </div>";

            }else{
                echo "<div class='alert alert-danger'> NO HAY DATOS DE ESTE USUARIO </div>";
           }

        }

    }










    //--------------------------    CAMBIAR LA CONTRASEÑA   ----------------------------

    /* Este bloque de código está comprobando si se ha pulsado el botón "botonCambiarClave" y si los
    campos "claveNueva" y "confirmClaveNueva" no están vacíos. Si se cumplen ambas condiciones,
    comprueba si los dos campos de contraseña coinciden. Si no coinciden, muestra un mensaje de
    error. Si coinciden, recupera el correo electrónico del usuario de la sesión, genera una versión
    hash de la nueva contraseña mediante la función "password_hash" y actualiza la contraseña del
    usuario en la base de datos mediante la función "modificarClave". Finalmente, muestra un mensaje
    de éxito. */
    if(!empty($_POST["botonCambiarClave"])){

        if($_POST["claveNueva"] != $_POST["confirmClaveNueva"]){

            echo "<div class='alert alert-danger text-center'> LA CONTRASEÑA NO COINCIDE </div>";           

        }else{

            $email= $_SESSION["email"];
            $clave = $_POST["claveNueva"];
            $claveCodificada = password_hash($clave, PASSWORD_DEFAULT);
            
             modificarClave($claveCodificada, $email);   
            
            echo "<div class='alert alert-success text-center'> CONTRASEÑA MODIFICADA CON ÉXITO </div>";   
        }


    }

    


?>