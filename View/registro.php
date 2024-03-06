<?php

/* 
* El archivo "headerInicio.php" es el que contiene el código necesario para la cabecera.
*/
require_once("../Parts/headerInicio.php");

?>

           

<div class="container posicion" >  
    <div class="text-center">     
        <h3>Registro</h3>
     </div>  

        <?php
        /* 
        * Se incluye el archivo `registroUsuarioController.php`, este archivo controla los datos de registro de los usuarios.
        */
          require_once("../Controller/registroUsuarioController.php");       
        ?>

<!-- Formulario de registro-->
<form id="formRegistro" action="registro.php" method="POST" class="row g-3 needs-validation" validate>
     <div class="col-md-4">
       <label>Nombre:</label><br>
        <input class="form-control" type="text" name="nombre" id="nombre" required> <br>
     </div>
     <div class="col-md-4">
        <label>Primer apellido:</label><br>
        <input class="form-control" type="text" name="apellido1" id="apellido1" required> <br>
    </div>
     <div class="col-md-4">
        <label>Segundo apellido:</label><br>
        <input class="form-control" type="text" name="apellido2" id="apellido2" > <br>
    </div>
    <div class="col-md-4">
        <label>DNI:</label><br>
        <input class="form-control" type="text" name="DNI" id="DNI" required> 
        <div class="form-text"> 8 dígitos y 1 letra mayúscula*</div><br>
    </div>
    <div class="col-md-4">
        <label>Móvil:</label><br>
        <input class="form-control" type="text" name="movil" id="movil" required> <br>
    </div>
    <div class="col-md-4">
        <label>Email:</label><br>
        <input class="form-control" type="text" name="email" id="email" required><br>
    </div>
    <div class="col-md-4">
        <label>Instrumento:</label><br>
            <select class="form-select" id="instrumento" name= "instrumento" required>
                <option selected disabled value="">Instrumento</option>
                <?php $instrumentos = mysqli_fetch_assoc(getInstrumentos());   
                        selectInstrumentos($instrumentos['idInstrumento']); ?> 
            </select><br>
    </div>
    <div class="col-md-4">
        <label>Contraseña:</label><br>
        <input class="form-control" type="password" name="clave" id="clave" required> <br>
    </div>
    <div class="col-md-4">
        <label>Confirmar Contraseña:</label><br>
        <input class="form-control" type="password" name="confirmClave" required> <br>
    </div>
    
    <div class="row text-center justify-content-center">
    <div class="col-md-4">
        <label>Código administración:* (campo no obligatorio)</label><br>
        <input class="form-control" type="password" name="codigo"> <br>
    </div>
    </div>
    <div class="row justify-content-center">
    <div class="col-md-11 text-center">
        <input type="submit" class="btn btn-primary" name="boton1" id="botonRegistro" value="Regístrate"><br>
    </div>
    </div>
    </form>
</div>
 



<?php

/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
require_once("../Parts/footer.php");

?>