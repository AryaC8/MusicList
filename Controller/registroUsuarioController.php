<?php

/* Estas líneas de código incluyen los archivos `usuarioModel.php` e `instrumentoModel.php` del
directorio `Model` y `Persona` de las Clases. Esto se hace para que las funciones y clases
definidas en esos archivos puedan usarse. */
require_once("../Model/usuarioModel.php");
require_once("../Model/instrumentoModel.php");
require_once("../Clases/Persona.php");



//--------------------------    REGISTRO DE USUARIOS   ----------------------------
 
/**
 * Esta función muestra un select de los instrumentos registrados en la base de datos 
 * para el formulario de registro y permite que el usuario pueda escoger entre ellos.
 */
 function selectInstrumentos() {
	
  $instrumentos = getInstrumentos();			

      while ($linea = mysqli_fetch_assoc($instrumentos) ){				
          echo "<option value='" . $linea ["idInstrumento"] . "'>" . $linea["nombre"] . "</option>";       
      }			
}




/* Se está comprobando si se ha hecho clic en el botón "boton1" en el formulario de registro de usuario.
    Si es así, comprueba si se han rellenado todos los campos, si no es así, muestra un
    mensaje de error. 
    Evalúa si la contraseña coincide las dos veces que se debe introducir para comprobar que es la correcta, 
    si no coinciden lanzará un mensaje de error.
    También comprueba que el email introducido no exista en la base de datos, si ya existe lanzará un mensaje de error.
    Si todo está debidamente cumplimentado, guarda al usuario en la base de datos (dependiendo de si introduce el código o no 
    tendrá un rol u otro) y muestra un mensaje de éxito. */
if(!empty($_POST["boton1"])){ 

  //Si hay algún cmapo vacío.
  if(empty($_POST["nombre"]) || empty($_POST["apellido1"]) || empty($_POST["DNI"]) || 
    empty($_POST["movil"]) || empty($_POST["email"]) || empty($_POST["instrumento"]) || empty($_POST["clave"] || empty($_POST["confirmClave"]))){

      echo "<div class='alert alert-danger text-center'> CAMPOS VACÍOS </div>";

  //Si la contraseña no coincide las dos veces que se ha de introducir para verificarla.
  }else if($_POST["clave"] != $_POST["confirmClave"]){

    echo "<div class='alert alert-danger text-center'> LA CONTRASEÑA NO COINCIDE </div>";

  //Si ya existe el email registrado en la base de datos.
  }else if (isset($_POST["email"])) {
    
       $email=$_POST["email"];

       $revisar = getUsuarioCompleto($email);

    if($revisar-> num_rows > 0){ 
     
         echo "<div class='alert alert-danger text-center'> El Email introducido ya existe </div>";        

    //Si todo está correcto, registra al usuario.     
    }else{

      $nombre=$_POST["nombre"];
      $apellido1=$_POST["apellido1"];
      $apellido2=$_POST["apellido2"];
      $dni=$_POST["DNI"];
      $movil=$_POST["movil"];
      $email=$_POST["email"];
      $instrumento=$_POST["instrumento"];
      $clave=$_POST["clave"];
      $claveCodificada = password_hash($clave, PASSWORD_DEFAULT); 
      $codigo = $_POST["codigo"];
      $admin = 0000;

    //Comprueba que el DNI tenga un formato válido. Si es así, registra al usuario.
    $regex="/^(\d{8})([A-Z]{1})$/";

    if (preg_match($regex, $dni)) {
        
      $DNI = $_POST["DNI"];

    //Si el usuario introduce el código de administración tendrá rol administrador.
      if (!empty($codigo) && ($codigo == $admin)) {
  
          $persona = new TipoUser($nombre, $apellido1, $apellido2, $DNI, $movil, $email, $instrumento, $claveCodificada);
          $persona-> setPermiso("1");
          $usuario = anadirUsuario($persona->nombre, $persona->apellido1, $persona->apellido2, $persona->DNI, $persona->movil, $persona->email, $persona->instrumento, $persona->claveCodificada, $persona->getPermiso());
          $persona-> confirmarUser($usuario);

      //Si se introduce el código de administración pero de forma errónea.
      }else if(!empty($codigo) && ($codigo != $admin)){

          echo "<div class='alert alert-danger text-center'> CÓDIGO ADMINISTRACIÓN INCORRECTO </div>";
        
      //Si el usuario no introduce el código de administración tendrá rol usuario. 
      }else if(empty($codigo)){
        
          $persona = new TipoUser($nombre, $apellido1, $apellido2, $DNI, $movil, $email, $instrumento, $claveCodificada);
          $persona-> setPermiso("0");
          $usuario = anadirUsuario($persona->nombre, $persona->apellido1, $persona->apellido2, $persona->DNI, $persona->movil, $persona->email, $persona->instrumento, $persona->claveCodificada, $persona->getPermiso());
          $persona-> confirmarUser($usuario);
      }
      
    //Si el formato del DNI no es válido.  
    }else{

      echo "<div class='alert alert-danger text-center'> DNI INVÁLIDO <br> Introduce 8 dígitos y una letra mayúscula. </div>";

    }

      
    }
  }
}




//--------------------------    MODIFICAR DATOS DE USUARIO   ----------------------------

/* Se está comprobando si se ha hecho clic en el botón "botonCambiarDatos" en el formulario para cambiar datos del usuario.
    Si es así, comprueba si se han rellenado todos los campos, si no es así, muestra un
    mensaje de error. 
    Si todo está debidamente cumplimentado, obtiene los datos introducidos para modificar los datos y muestra un mensaje de éxito.
    Para poder realizar esta acción se pide la contraseña del usuario y se hace una comprobación.
*/
  if(!empty($_POST["botonCambiarDatos"])){

    //Si hay algún cmapo vacío.
    if(empty($_POST["nombre"]) || empty($_POST["apellido1"]) || empty($_POST["DNI"]) || 
      empty($_POST["movil"]) || empty($_POST["instrumento"]) || empty($_POST["clave"])){

        echo "<div class='alert alert-danger text-center'> CAMPOS VACÍOS </div>";

    //Si todo está correcto, registra al usuario. 
    }else{

      $nombre=$_POST["nombre"];
      $apellido1=$_POST["apellido1"];
      $apellido2=$_POST["apellido2"];
      $dni=$_POST["DNI"];
      $movil=$_POST["movil"];
      $instrumento=$_POST["instrumento"];
      $clave=$_POST["clave"];
      $idPersona = $_SESSION["idPersona"];
      $email = $_POST["email"];

    
      $user = getUsuarioCompleto($email);

      while($usuario = mysqli_fetch_assoc($user)){

        $claveCodificada = $usuario["clave"];
        $email=$usuario["email"];

      }  

      //Comprueba que la contraseña introducida y la registrada del usuario sean la misma.
      if(password_verify($clave, $claveCodificada)){  
        
        //Comprueba que el DNI tenga un formato válido. Si es así, registra al usuario.
          $regex="/^(\d{8})([A-Z]{1})$/";

          if (preg_match($regex, $dni)) {
        
            $DNI = $_POST["DNI"];
      
            $persona = new Persona($nombre, $apellido1, $apellido2, $DNI, $movil, $email, $instrumento, $claveCodificada);
            modificarUsuario($persona->nombre, $persona->apellido1, $persona->apellido2, $persona->DNI, $persona->movil, $persona->instrumento, $idPersona);
    
            echo "<div class='alert alert-success text-center'> 
            USUARIO MODIFICADO CON ÉXITO. <br>
            CIERRE SESIÓN PARA CONFIRMAR LOS CAMBIOS E INICIE SESIÓN.
            </div>";
            
          }else{ 

              echo "<div class='alert alert-danger text-center'> DNI INVÁLIDO <br> Introduce 8 dígitos y una letra mayúscula. </div>";         
                 
          }

          //Si la contraseña no coincide, lanza un mensaje de error.  
          
      }else{

            echo "<div class='alert alert-danger text-center'> CONTRASEÑA INCORRECTA </div>";

      }
        
    }
  }





//--------------------------    MODIFICAR EMAIL   ----------------------------

/* Se está comprobando si se ha hecho clic en el botón "botonCambiarEmail" en el formulario para cambiar el email del usuario.
    Si es así, comprueba si se han rellenado todos los campos, si no es así, muestra un
    mensaje de error. 
    Comprueba si el email anterior coincide con algún registro de la base de datos, si no es así, muestra un
    mensaje de error. 
    También comprueba que el nuevo email no esté ya registrado en la base de datos, si es así, muestra un
    mensaje de error.
    Si todo está debidamente cumplimentado, obtiene los datos introducidos en el formulario para modificar el email
    y muestra un mensaje de éxito.
    Para poder realizar esta acción se pide la contraseña del usuario y se hace una comprobación.
*/
if(!empty($_POST["botonCambiarEmail"])){

  //Si hay algún cmapo vacío.
  if(empty($_POST["emailAnterior"]) || empty($_POST["emailNuevo"]) || empty($_POST["confirmEmailNuevo"]) || empty($_POST["clave"])){

      echo "<div class='alert alert-danger text-center'> CAMPOS VACÍOS </div>";

  //Si coincide el email anterior con algún registro de la base de datos.
  }else if($_POST["emailNuevo"] != $_POST["confirmEmailNuevo"]){

    echo "<div class='alert alert-danger text-center'> EL EMAIL NO COINCIDE </div>";     

  }else{
  
    $emailAnterior = $_POST["emailAnterior"];
    $emailNuevo=$_POST["emailNuevo"];
    $clave = $_POST["clave"];           
    
        $revisar = getUsuarioCompleto($emailNuevo);

        while($usuario = mysqli_fetch_assoc($revisar)){

          $claveCodificada = $usuario["clave"];
          $email=$usuario["email"];
  
        }

        //Comprueba si existe el email nuevo registrado en la base de datos.
        if($revisar-> num_rows > 0){ 
      
          echo "<div class='alert alert-danger text-center'> EL EMAIL INTRODUCIDO YA EXISTE </div>"; 
         
        //Si todo está correcto, registra al usuario. 
        }else{
        
          $user = getUsuarioCompleto($emailAnterior);

          while($datos = mysqli_fetch_assoc($user)){

            $claveCodificada = $datos["clave"];
          
          }
        
          //Comprueba que la contraseña introducida y la registrada del usuario sean la misma.
          if(isset($claveCodificada)){
        
            if(password_verify($clave, $claveCodificada)){                      
  
              modificarEmail($emailNuevo, $idPersona);

              echo "<div class='alert alert-success text-center'> 
                  EMAIL MODIFICADO CON ÉXITO. <br>
                  CIERRE SESIÓN PARA CONFIRMAR LOS CAMBIOS E INICIE SESIÓN CON EL NUEVO EMAIL. 
              </div>";
            }

            //Si la contraseña no coincide, lanza un mensaje de error. 
          }else{

           echo "<div class='alert alert-danger text-center'> CONTRASEÑA INCORRECTA </div>";

          }
        }
        
  }
}
  



?>