
<?php

/* Estas líneas de código incluyen el archivo PHP necesario para que el script funcione
* correctamente. `eventosController.php` es un archivo controlador que contiene las funciones relacionadas con 
* los eventos.
* El archivo "headerHome.php" es el que contiene el código necesario para la cabecera. 
*/
require_once("../Parts/headerHome.php");  
require_once("../Controller/eventosController.php");   

$sesion = new Sesion();


      /* 
      * Dependiendo de si existe la variable de sesión "rol" y del valor que tenga, el usuario tendrá permiso para
      * visualizar esta página o no. Solamente tendrá permiso el usuario con rol de administrador.
      */
    if (!isset($_SESSION["rol"]) || isset($_SESSION["rol"]) && ($_SESSION["rol"] != "admin")){

      header("location:../View/sinPermiso.php");

    }



/* 
* Si el administrador elige la opción de modificar un evento.
*/
if(isset($_GET["Modificar"])){						
                    
    $modificar = mysqli_fetch_assoc(getEvento($_GET["Modificar"]));	
    
            
/* 
* Si el administrador elige la opción de borrar un evento.
*/           
}else if(isset($_GET["Borrar"])){			
                
    $modificar = mysqli_fetch_assoc(getEvento($_GET["Borrar"]));				
            
    }	
    
/* 
* Si existe la variable con los datos del evento, se crea un formulario con los datos de ese evento en concreto.
*/
    if(isset($modificar)) {   
    ?>  
    <div class="container mt-5" >
        <div class="row">
        <form id="evento" action="modificarEventoAdmin.php" method="GET">
        <p><label> ID: </label>
            <input class="form-control" type ="number" value = '<?php echo $modificar["idActo"]; ?>' aria-label="Disabled input example" disabled></p>
            <input type ="hidden" name ="idActo" value = '<?php echo $modificar["idActo"]; ?>'></p>
        <p><label> Nombre del evento: </label>				
            <input class="form-control" type ="text" name="nombreActo" value="<?php echo $modificar['nombreActo']; ?>" ></p>				
        <p><label> Fecha: </label>
            <input class="form-control" type="date" name="fecha" value = "<?php echo $modificar['fecha']; ?>" ></p>
        <p><label> Hora: </label>
            <input class="form-control" type ="time" name = "hora" value = "<?php echo $modificar['hora']; ?>"></p>
        <p><label> Dirección: </label>
            <input class="form-control" type ="text" name = "direccion" value = "<?php echo $modificar['direccion']; ?>"></p>
        <p><label> Comentario: </label>
            <input class="form-control" type ="input-group-text" name = "comentario" value = "<?php echo $modificar['comentario']; ?>"></p>	                              
                        
    <?php
        /* 
        * Si la elección ha sido modificar el evento, aparece el botón para mandar los datos y modificarlo.
        */     
       if(isset($_GET["Modificar"])){
            
        echo "<div class = 'container position-relative'>
                <div class= 'position-absolute top-50 start-50'>
                    <input id='boton1' class='btn btn-success' type ='submit' name ='Eleccion' value ='Modificar'>
                </div>
            </div>";
        
        
    /* 
    * Si la elección ha sido borrar el evento, aparece el botón para borrarlo.
    */ 
    }else if (isset($_GET["Borrar"])){
    
        echo "<div class = 'container position-relative'>
                <div class= 'position-absolute top-50 start-50'>
                    <input id='boton2' class='btn btn-danger' type ='submit' name ='Eleccion' value ='Borrar'>
                </div>
            </div>";
    
    }

    echo "</form>"; 
}
        
            editarEvento();    
    
    echo   "</div>
            </div>";
    

    /*
    * Botón para vovler a la página anterior. 
    */
    echo "<div class = 'container mt-5'>
            <div class= 'd-flex justify-content-start'>
                <div id = 'botonVolver' class='text-center'>
                <a class='btn btn-info' href='../View/listaEventoAdmin.php'>Volver a Eventos</a>
                </div>
            </div>
        </div>";
        

    
/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
        require_once("../Parts/footer.php");  
    ?>


