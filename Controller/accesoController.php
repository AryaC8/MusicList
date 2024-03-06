<?php

/* Estas líneas de código incluyen los archivos PHP necesarios para que el script funcione
correctamente. `usuarioModel.php` e `instrumentoModel.php` son archivos modelo que contienen
funciones para interactuar con la base de datos relacionada con usuarios e instrumentos.
`Sesiones.php` es un archivo de clase que contiene funciones para administrar sesiones en PHP. Al
incluir estos archivos, el script puede acceder a las funciones y clases definidas en ellos. */
require_once("../Model/usuarioModel.php");
require_once("../Model/instrumentoModel.php");
require_once("../Clases/Sesiones.php");



/**
 * La función establece los atributos de la sesión en función de la información del usuario y redirige
 * a diferentes páginas según el tipo de usuario.
 * 
 * @param email La dirección de correo electrónico del usuario para el que se comprueban los permisos.
 */
function permisos($email){

    /* Este bloque de código verifica si el campo "email" existe en la solicitud
   POST. Si es así, recupera la información del usuario de la base de datos utilizando la
   dirección de correo electrónico, establece los atributos del usuario en un objeto de sesión y
   redirige al usuario a diferentes páginas según su tipo de usuario (administrador o usuario). */
    if (isset($_POST["email"])) {

        $email = $_POST["email"];




        $sesion = new Sesion();
        
        // Se asignan los id de cada registro
        $usuario = mysqli_fetch_assoc(getUsuario($email));       

        $sesion-> setAttribute("usuario", $usuario["Usuario"]);
                
        $sesion-> setAttribute("idPersona", $usuario["idPersona"]); 

        $sesion-> setAttribute("instrumento", $usuario["instrumento"]); 


        
        //Se asignan los datos
        $usuarioCompleto = mysqli_fetch_assoc(getUsuarioCompleto($email)); 

        $sesion-> setAttribute("nombre", $usuarioCompleto["nombre"]);

        $sesion-> setAttribute("apellido1", $usuarioCompleto["apellido1"]);

        $sesion-> setAttribute("apellido2", $usuarioCompleto["apellido2"]);

        $sesion-> setAttribute("DNI", $usuarioCompleto["DNI"]); 

        $sesion-> setAttribute("movil", $usuarioCompleto["movil"]); 

        $sesion-> setAttribute("email", $usuarioCompleto["email"]); 


        //Qué instrumento tiene registrado el usuario
        $instrumento = mysqli_fetch_assoc(getInstrumento($_SESSION["instrumento"]));

        $sesion-> setAttribute("nombreInstrumento", $instrumento["nombre"]);



        

       /* Este bloque de código utiliza una declaración de cambio para comprobar el tipo de usuario en
       función de su dirección de correo electrónico. Si el usuario es un administrador, establece
       el atributo "rol" de la sesión en "admin" y lo redirige a la página homeAdmin.php. Si el
       usuario es un usuario normal, establece el atributo "rol" en "usuario" y lo redirige a la
       página homeUser.php. */
        switch(tipoUsuario($email)){
            case "admin":

                $sesion-> setAttribute("rol", "admin");             

                header("location:../View/homeAdmin.php"); 
                     
                break;


            case "user":

                $sesion-> setAttribute("rol", "user");           
                
                header("location:../View/homeUser.php");
               
                break;
        }
    }
}



    /* Este bloque de código está comprobando si se ha pulsado el botón "botonInicioSesion"
   en el formulario de inicio de sesión y si los campos "email" y "clave" no están vacíos. 
   Si los campos están vacíos, muestra un mensaje de error. 
   Si los campos no están vacíos, recupera el correo electrónico y la contraseña del formulario 
   y verifica la contraseña mediante la función password_verify(). Si se verifica la
   contraseña, llama a la función "validarUsuario" para verificar si el usuario existe en la base de
   datos y luego llama a la función "permisos" para establecer los atributos de la sesión y
   redirigir al usuario a la página adecuada según su tipo de usuario. Si no se verifica la
   contraseña, muestra un mensaje de "Acceso Denegado". 
   */
    if(!empty($_POST["botonInicioSesion"])){

        //Si hay algún campo vació en el formulario
        if(empty($_POST["email"]) && (empty($_POST["clave"]))){
            echo "<div class='alert alert-danger'> campos vacíos </div>";

        }else if(isset($_POST["email"]) && (isset($_POST["clave"]))){

            $email = $_POST["email"];
            $clave = $_POST["clave"];     
            
            //Verifica que exista un usuario con el email introducido
            $verificar = getUsuarioCompleto($email);

            //Extrae la clave que tiene registrada
            
            while($datos= mysqli_fetch_assoc($verificar)){

                $claveCodificada = $datos["clave"];

            }   

            //Comprueba que la clave introducida en el formulario de ingreso sea igual a la guardada en la BBDD
            if(isset($claveCodificada)){

                if(password_verify($clave, $claveCodificada)){
            
           
                    $sql= validarUsuario($email, $claveCodificada);           
                            
                        //Una vez verificado inicia la función para determinar las variables de sesión y los permisos
                        if($datos= mysqli_fetch_assoc($sql)){               

                            permisos($datos['email']);             
                
                        }

                }
            }else{

                //Si el emai introducido no existe en la base de datos 
                echo "<div class='alert alert-danger'> ACCESO DENEGADO </div>";

            }
        }

    }
?>