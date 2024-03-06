<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="../Public/css/home.css" type="text/css" rel="stylesheet">
    <title>Home - MusicList</title>
</head>
<body>


<?php

/* 
* Se incluye el archivo `accesoController.php`, este archivo controla los datos de inicio de sesión.
*/
    require_once("../Controller/accesoController.php");



    $sesion = new Sesion();


/* 
* Dependiendo de si existe la variable de sesión "rol" y del valor que tenga, el usuario tendrá permiso para
* visualizar esta página o no. Solamente tendrá permiso el usuario con rol de administrador.
*/
    if (!isset($_SESSION["rol"])  ){

        header("location:../View/sinPermiso.php");  

    }
?>




<!-- Bloque que contiene la barra de navegación del apartado de cuenta. En ella están los diferentes enlaces para acceder a 
las secciones. Como información, aparece el logo de la aplicación y el nombre de  del usuario. 
Las secciones presentes en cuenta son: Cambiar datos, Cambiar contraseña, cambiar email, 
volver al inicio (dependiendo de los permisos que tenga el usuario vovlerá a la página de administrador o a la de usuario)
y cerrar sesión (para cerrar la aplicación). -->
<div class="container-fluid">
    <div class="row">
        <div class="bg-dark col-auto col-md2 min-vw-100 text-center">
            <div class="text-white">
                <h5 class="display-6">MusicList<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
                    <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z"/>
                    <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/></svg></h5>
            </div>
            <div class="text-white">
                <h6>Cuenta</h6>
                <h6 class="nombreCuenta">
                    <?php if(isset($_SESSION['usuario'])){echo "<h6>" . $_SESSION['usuario'];}?>
                </h6>
            </div>
        <br>
            <ul class="nav justify-content-center nav-tabs">
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" href="cuenta.php?cambiardatos">Cambiar datos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="cuenta.php?cambiarcontraseña">Cambiar contraseña</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="cuenta.php?cambiaremail">Cambiar email</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="
                        <?php if(isset($_SESSION["rol"]) && ($_SESSION["rol"] == "user")){echo '../View/homeUser.php';}
                        if(isset($_SESSION["rol"]) && ($_SESSION["rol"] == "admin")){echo '../View/homeAdmin.php';}?>">
                        Volver al inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../Controller/cerrarSesionController.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</div>




 <!-- APARTADO PARA CAMBIAR ALGUNO/TODOS LOS DATOS DEL USUARIO YA REGISTRADO   -->

<?php

/*
* Si el usuario escoge cambiar los datos, entonces se extren sus datos registrados en la base de datos mediante su Id,
* utilizando la variable de sesión. En el formulario aparecen esos datos para poderlos modificar (el único dato que no 
* se puede modificar es el email, ya que por seguridad es mejor hacerlo aparte).
*/
    if(isset($_GET["cambiardatos"])){
 
        $idPersona = $_SESSION["idPersona"];

        $user = getUserConId($idPersona);

        $usuario = mysqli_fetch_assoc($user); 
        
        if(isset($usuario)){
            
            $nombre = $usuario["nombre"];
            $apellido1 = $usuario['apellido1'];
            $apellido2 = $usuario['apellido2'];
            $DNI = $usuario['DNI'];
            $movil = $usuario['movil'];
            $email = $usuario['email'];
            $instrumento = $usuario['instrumento'];
        }                    
        ?>
<div class="container col-11 mt-5">
    <div class="text-center">
        <h3>MODIFICAR DATOS</h3>
    </div>

        <?php
        /* 
        * Se incluye el archivo `registroUsuarioController.php`, este archivo controla los datos de registro.
        */
          require_once("../Controller/registroUsuarioController.php");
        ?>

        <!-- Formulario para modificar los datos del usuario-->
    <div class= "row">
        <form action="cuenta.php?cambiardatos" method="POST" class="row g-3 needs-validation" validate>
            <div class="col-md-4">
                <label>Nombre:</label><br>
                <input class="form-control" type="text" name="nombre" id="nombre" required value="<?php echo $nombre; ?>"> <br>
            </div>
            <div class="col-md-4">
                <label>Primer apellido:</label><br>
                <input class="form-control" type="text" name="apellido1" id="apellido1" required value="<?php echo $apellido1; ?>"> <br>
            </div>
            <div class="col-md-4">
                <label>Segundo apellido:</label><br>
                <input class="form-control" type="text" name="apellido2" id="apellido2" value="<?php echo $apellido2; ?>"> <br>
            </div>
            <div class="col-md-4">
                <label>DNI:</label><br>
                <input class="form-control" type="text" name="DNI" id="DNI" required value="<?php echo $DNI; ?>">
                <div class="form-text"> 8 dígitos y 1 letra mayúscula*</div><br>
            </div>
            <div class="col-md-4">
                <label>Móvil:</label><br>
                <input class="form-control" type="text" name="movil" id="movil" required value="<?php echo $movil; ?>"> <br>
            </div>
            <div class="col-md-4">
                <label>Email:  *No puede modificarse</label><br>
                <input class="form-control" type="text" name="email" id="email" value="<?php echo $email; ?>" readonly><br>
            </div> 
            <div class="col-md-4">
                <label>Instrumento:</label><br>
                    <select class="form-select" id="instrumento" name= "instrumento" required>
                        <option selected value="<?php echo $instrumento;?>"><?php echo $_SESSION['nombreInstrumento']; ?></option>
                            <?php $instrumentos = mysqli_fetch_assoc(getInstrumentos());
                            selectInstrumentos($instrumentos['idInstrumento']); ?>
                    </select><br>
            </div>
            <div class="col-md-4">
                <label>Contraseña:</label><br>
                <input class="form-control" type="password" name="clave" id="clave" required> <br>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-11 text-center">
                    <input type="submit" class="btn btn-primary" name="botonCambiarDatos" id="botonCambiarDatos" value="Modificar"><br>
                </div>
            </div>
        </form>
    </div>
</div>
    







 <!-- APARTADO PARA CAMBIAR EL EMAIL   -->

<?php
        
    /*
    * Si el usuario escoge cambiar el email, se crea un formulario para que ingrese los datos requeridos y 
    * se formalice ese cambio.
    */
    }else if(isset($_GET["cambiaremail"])){

        $idPersona = $_SESSION["idPersona"];

        $user = getUserConId($idPersona);

        $usuario = mysqli_fetch_assoc($user); 
        
        if(isset($usuario)){
            
            $email = $usuario['email'];
            
        }                  
                         
?>


<div class="container col-11 mt-5">
    <div class="text-center">
        <h3>MODIFICAR EMAIL</h3>
    </div>

        <?php
        /* 
        * Se incluye el archivo `registroUsuarioController.php`, este archivo controla los datos de registro.
        value="<?php echo $email; ?>"
        */
          require_once("../Controller/registroUsuarioController.php");
        ?>

         <!-- Formulario para modificar el email del usuario-->
    <div class= "row">
        <form action="cuenta.php?cambiaremail" method="POST" class="row g-3 needs-validation" validate>
            <div class="col-md-6">
                <label>Email anterior:</label><br>
                <input class="form-control" type="text" name="emailAnterior" id="emailAnterior" required><br>
            </div>
            <div class="col-md-6">
                <label>Nuevo Email:</label><br>
                <input class="form-control" type="text" name="emailNuevo" id="emailNuevo" required> <br>
            </div>
            <div class="col-md-6">
                <label>Confirmar email:</label><br>
                <input class="form-control" type="text" name="confirmEmailNuevo" id="confirmEmailNuevo" required> <br>
            </div>
            <div class="col-md-6">
                <label>Contraseña:</label><br>
                <input class="form-control" type="password" name="clave" id="clave" required> <br>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-11 text-center">
                    <input type="submit" class="btn btn-primary" name="botonCambiarEmail" id="botonCambiarEmail" value="Modificar"><br>
                </div>
            </div>
        </form>
    </div>
</div>








 <!-- APARTADO PARA CAMBIAR LA CONTRASEÑA   -->


<?php

    /*
    * Si el usuario escoge cambiar la contraseña, se crea un formulario para que ingrese los datos requeridos y 
    * se formalice ese cambio.
    */
    }else if(isset($_GET["cambiarcontraseña"])){
    ?>


    <div class="container col-11 mt-5">
        <div class="text-center">
            <h3>MODIFICAR CONTRASEÑA</h3>
         </div>

            <?php
             /* 
            * Se incluye el archivo `recuperarClaveController.php`, utilizado para realizar las diversas
            * gestiones de la contraseña.
            */
              require_once("../Controller/recuperarClaveController.php");
            ?>

    <!-- Formulario para modificar la contraseña del usuario-->   
    <div class= "row">
    <form action="cuenta.php?cambiarcontraseña" method="POST" class="row g-3 needs-validation" novalidate>
          <div class="col-md-6">
            <label>Nueva Contraseña:</label><br>
            <input class="form-control" type="password" name="claveNueva" id="clave" required> <br>
        </div>
        <div class="col-md-6">
            <label>Confirmar Contraseña:</label><br>
            <input class="form-control" type="password" name="confirmClaveNueva" required> <br>
        </div>
        <div class="row justify-content-center">
        <div class="col-md-11 text-center">
            <input type="submit" class="btn btn-primary" name="botonCambiarClave" id="botonCambiarClave" value="Modificar"><br>
        </div>
        </div>
        </form>
        </div>
    </div>



<?php
}
/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
require_once("../Parts/footer.php");

?>
