<?php

/* Estas líneas están importando archivos y clases necesarios para que el código PHP funcione
correctamente. `eventosModel.php` contiene funciones relacionadas con eventos, `Acto.php` contiene
la definición de clase para el objeto `Acto`, `asistenciaController.php` contiene funciones
relacionadas con la gestión de asistencia, y `accesoController.php` contiene funciones relacionadas
con la gestión acceso de usuario. */
require_once("../Model/eventosModel.php");
require_once("../Clases/Acto.php");     
require_once("asistenciaController.php");
require_once("accesoController.php");


/**
 * Esta función crea un evento y lo agrega a una lista si se completan todos los campos obligatorios del formulario.
 */
function crearEvento(){

    if(isset($_POST["botonEvento"])){

        //Si hay algún campo requerido vacío
        if(empty($_POST["nombreActo"]) && (empty($_POST["fecha"])) && (empty($_POST["hora"])) && (empty($_POST["direccion"]))){
            echo "<div class='col-7 alert alert-danger text-center'> CAMPOS VACÍOS </div>";

        }else{

            $nombreActo = $_POST["nombreActo"];
            $fecha = $_POST["fecha"];
            $hora = $_POST["hora"];
            $direccion = $_POST["direccion"];
            $comentario = $_POST["comentario"];

            $acto = new Acto($nombreActo, $fecha, $hora, $direccion, $comentario);

             anadirEvento($acto->nombreActo,$acto->fecha, $acto->hora, $acto->direccion, $acto->comentario);

            echo "<div class='col-7 alert alert-success text-center'> EVENTO REGISTRADO </div>";

        }

    }

}


/**
 * Esta función muestra en una tabla los próximos eventos y proporciona un enlace para validar la asistencia a cada
 * evento.
 */
function mostrarEventoParaValidarAsistencia(){  

    $evento = getEventosFuturos();

    while($td = mysqli_fetch_assoc($evento)){

        $fecha = date_create($td ['fecha']);
        $hora = date_create($td ['hora']);

        echo "<tr>\n
        <td>" . $td ['idActo'] . "</td>\n
        <td>" . $td ['nombreActo'] . "</td>\n
        <td>" . date_format($fecha, 'd-m-Y') . "</td>\n
        <td>" . date_format($hora, 'H:i') . "</td>\n
        <td>" . $td ['direccion'] . "</td>\n
        <td>" . $td ['comentario'] . "</td>\n
        <td> <a href= '../View/validarAsistenciaAdmin.php?Validar=" . $td['idActo'] . "'>Validar</a> </td>\n
        </tr>\n";
    }  

}


/**
 * La función muestra en una tabla eventos pasados con sus detalles y un enlace para revisar la asistencia de un
 * usuario administrador.
 */
function mostrarEventosPasados(){

$eventosPasados = getEventosPasados();

    while($td = mysqli_fetch_assoc($eventosPasados)){

        $fecha = date_create($td ['fecha']);
        $hora = date_create($td ['hora']);

        echo "<tr>\n
        <td>" . $td ['idActo'] . "</td>\n
        <td>" . $td ['nombreActo'] . "</td>\n
        <td>" . date_format($fecha, 'd-m-Y') . "</td>\n
        <td>" . date_format($hora, 'H:i') . "</td>\n
        <td>" . $td ['direccion'] . "</td>\n
        <td> <a href= '../View/revisarAsistenciaAdmin.php?AsistenciaValidada=" . $td['idActo'] . "'>Asistencia</a></td>\n
        </tr>\n";

    }

}


/**
 * Esta función muestra en una tabla los próximos eventos para un usuario administrador, incluidos su ID, nombre,
 * fecha, hora, ubicación, comentarios y enlaces para modificar o eliminar el evento.
 */
function mostrarEventoFuturoAdmin(){  

    $eventosFuturos = getEventosFuturos();

    while($td = mysqli_fetch_assoc($eventosFuturos)){

        $fecha = date_create($td ['fecha']);
        $hora = date_create($td ['hora']);

        echo "<tr>\n
        <td>" . $td ['idActo'] . "</td>\n
        <td>" . $td ['nombreActo'] . "</td>\n
        <td>" . date_format($fecha, 'd-m-Y') . "</td>\n
        <td>" . date_format($hora, 'H:i') . "</td>\n
        <td>" . $td ['direccion'] . "</td>\n
        <td>" . $td ['comentario'] . "</td>\n
        <td> <a href= '../View/revisarAsistenciaAdmin.php?Asistencia=" . $td['idActo'] . "'>Asistencia</a></td>\n
        <td> <a href= '../View/modificarEventoAdmin.php?Modificar=" . $td['idActo'] . "'>Modificar</a>
            <a href= '../View/modificarEventoAdmin.php?Borrar=" . $td['idActo'] . "'>Borrar</a></td>\n
        </tr>\n";
    }  

}


/**
 * Esta función muestra los próximos eventos para un usuario y le permite confirmar su asistencia con
 * una respuesta de "Sí" o "No".
 */
function mostrarEventosUser(){


    $evento = getEventosFuturos();
    
    while($td = mysqli_fetch_assoc($evento)){
    
        $fecha = date_create($td ['fecha']);
        $hora = date_create($td ['hora']);
    
        echo "<tr class = 'text-center'>\n
        <td >" . $td ['idActo'] . "</td>\n
        <td>" . $td ['nombreActo'] . "</td>\n
        <td>" . date_format($fecha, 'd-m-Y') . "</td>\n
        <td>" . date_format($hora, 'H:i') . "</td>\n
        <td>" . $td ['direccion'] . "</td>\n
        <td class = 'text-start'>" . $td ['comentario'] . "</td>\n
        <td>
        <a href= '../View/listaEventosUser.php?Si=" . $td['idActo'] . "'>Sí</a>
        <a href= '../View/listaEventosUser.php?No=" . $td['idActo'] . "'>No</a>
        </td>\n
        </tr>\n";      
    
    }
       
}


/**
 * Esta función recupera y muestra eventos pasados de un usuario específico en una tabla.
 */
function mostrarEventosPasadosUSer(){

    $idPersona = $_SESSION["idPersona"];

    $eventosPasadosUser = getEventosPasadosUser($idPersona);  

    while($td = mysqli_fetch_assoc($eventosPasadosUser)){    
        
        $fecha = date_create($td ['fecha']);
        $hora = date_create($td ['hora']);
    
        echo "<tr>\n
        <td>" . $td ['nombreActo'] . "</td>\n
        <td>" . date_format($fecha, 'd-m-Y') . "</td>\n
        <td>" . date_format($hora, 'H:i') . "</td>\n
        <td>" . $td ['direccion'] . "</td>\n";
    
     }

}


/**
 * Esta función recupera y muestra eventos confirmados de un usuario en formato de tabla.
 */
function mostrarEventosConfirmadosUser(){


    $idPersona = $_SESSION['idPersona'];
    

    $eventosFuturosUser = getEventosFuturosUser($idPersona);

    while($td = mysqli_fetch_assoc($eventosFuturosUser)){    
        
        $fecha = date_create($td ['fecha']);
        $hora = date_create($td ['hora']);
    
        echo "<tr>\n
        <td>" . $td ['nombreActo'] . "</td>\n
        <td>" . date_format($fecha, 'd-m-Y') . "</td>\n
        <td>" . date_format($hora, 'H:i') . "</td>\n
        <td>" . $td ['direccion'] . "</td>\n";
    
     }

}




/* Esta es una función llamada `editarEvento()` que comprueba si el administrador ha seleccionado la opción
de modificar o eliminar un evento. Si el administrador ha seleccionado la opción de modificar un evento,
recupera la información necesaria del formulario y crea un nuevo objeto `Acto` con esa información.
Luego llama a la función `modificarEvento()` con `idActo` y las propiedades del objeto `Acto` como
argumentos para actualizar el evento en la base de datos. Si la actualización es exitosa, muestra
un mensaje de éxito; de lo contrario, muestra un mensaje de error. Si el usuario ha seleccionado la
opción de eliminar un evento, recupera el `idActo` del evento y llama a la función
`eliminarEvento()` con ese `idActo` como argumento para eliminar el evento de la base de datos. Si
la eliminación se realiza correctamente, muestra un mensaje de éxito; de lo contrario, muestra un
mensaje de error. */            
function editarEvento(){ 
      
if(isset($_GET["Eleccion"]) && ($_GET["Eleccion"] == "Modificar")){	
    
    $idActo= $_GET["idActo"];
    $nombreActo= $_GET["nombreActo"];
    $fecha= $_GET["fecha"];
    $hora= $_GET["hora"];
    $direccion= $_GET["direccion"];
    $comentario= $_GET["comentario"];

    $acto = new Acto($nombreActo, $fecha, $hora, $direccion, $comentario);
    
            
    if(modificarEvento($idActo, $acto->nombreActo, $acto->fecha, $acto->hora, $acto->direccion, $acto->comentario)){

        echo "<div class = 'container'>
                <div class= 'position-absolute top-50 start-50 translate-middle'>
                    <div class='alert alert-success' role='alert'> Se ha editado el evento </div> 
                </div> 
            </div>";       
        
    }else{

        echo "<div class = 'container'>
                <div class= 'position-absolute top-50 start-50 translate-middle'>
                    <div class=' container alert alert-danger' role='alert'> Evento no editado </div>
                </div> 
            </div>" ;        

    }
    

    
//Si la opcion es borrar, coge el valor ID del evento seleccionado
//y lo pasa a la funcion creada para borrarlo
}else if(isset($_GET["Eleccion"]) && ($_GET["Eleccion"] == "Borrar")){

    $idActo=$_GET["idActo"];

    if(eliminarEvento($idActo)){				
        
        echo "<div class = 'container'>
                <div class= 'position-absolute top-50 start-50 translate-middle'>
                    <div class='alert alert-success' role='alert'> Se ha borrado el evento </div> 
                </div> 
            </div>";        				

    }else{

        echo "<div class = 'container'>
                <div class= 'position-absolute top-50 start-50 translate-middle'>
                    <div class='alert alert-danger' role='alert'> Evento no borrado </div> 
                </div> 
            </div>";        

    }
}

}
?>