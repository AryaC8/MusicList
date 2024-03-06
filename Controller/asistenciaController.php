<?php

/* Importa los archivos y clases necesarios para administrar la asistencia y los
eventos en la aplicación. Incluye los modelos de asistencia y eventos, el controlador de acceso
y la clase para gestionar la asistencia. */
require_once("../Model/asistenciaModel.php");
require_once("../Model/eventosModel.php");
require_once("../Controller/accesoController.php");
require_once("../Clases/Asistencia.php");



    /* Este código filtra el valor de entrada de la llamada de AJAX para "anadirAsistente.php" y lo
    * asigna a la variable . Está usando el valor de "instrumento" para recuperar
    * una lista de asistentes de la base de datos usando la función
    * getAsistente(). El ciclo while está iterando a través de cada fila del conjunto de resultados e
    * imprimiendo un "<option>" elemento con el valor de  "idPersona" y visualizando el nombre de 
    * la persona "Asistente". Esto se usa para completar una lista desplegable 
    * de asistentes para el formulario de "anadirAsistente.php". 
    */
     $instrumento = filter_input(INPUT_POST, 'instrumento'); 

      $asistente = getAsistente($instrumento);

      while ($linea = mysqli_fetch_assoc($asistente) ){		

           echo "<option value='" . $linea ["idPersona"] . "'>" . $linea["Asistente"] . "</option>"; 
    
         }

  
 
    
    /* Se está comprobando si se ha hecho clic en el botón "Añadir" en un formulario.
    * Si es así, comprueba si se ha seleccionado un asistente. Si no es así, muestra un
    * mensaje de error y un enlace para agregar más asistentes. Si es así, crea una nueva instancia de
    * la clase "Asistencia" con los valores del formulario. También verifica si el asistente ya ha registrado
    * su asistencia y, en caso afirmativo, muestra un mensaje de error. Si el usuario no estaba registrado 
    * guarda la asistencia y muestra un mensaje de éxito. Luego muestra un enlace para agregar más asistentes. 
    */
    if(isset($_POST["Añadir"])){        
        

        if(!isset($_POST["nombreCompleto"])){

            echo "<div class = 'container'>
                <div class= 'position-absolute top-50 start-50 translate-middle'>
                    <div class='alert alert-danger' role='alert'>NINGÚN ASISTENTE SELECCIONADO </div>
                </div>
            </div>";

            echo "<div class = 'container d-flex justify-content-around'>                    
                    <a class='alert alert-info' href = '../View/anadirAsistente.php?anadir=" . $_POST["idActoNum"] . "'> Añadir más asistentes</a>                    
                </div>";

        //Si se seleciona un usuario. 
        }else{

            $acto=$_POST["idActoNum"];
            $asistente = $_POST["nombreCompleto"]; 
            $instrumento=$_POST["instrumentos"];

            $asistencia = new Asistencia($acto, $asistente, $instrumento);


          //Se comprueba si ya está registrado ese usuario como asisitente previsto
          $asis = comprobarAsistencia($asistencia->acto, $asistencia->asistente);        

          if($asis-> num_rows > 0){

              while($linea = mysqli_fetch_assoc($asis)){
                  $asist = $linea ['asistentes'];
              }            
                       echo "<div class = 'container'>
                           <div class= 'position-absolute top-50 start-50 translate-middle'>
                               <div class='alert alert-danger' role='alert'> LA ASISTENCIA YA HABÍA SIDO CONFIRMADA </div>
                           </div>
                       </div>";

          //Se guardan los disitintos datos en la tabla asistencia
          }else{

              guardarAsistencia($asistencia->acto, $asistencia->asistente, $asistencia->instrumento);

                       echo "<div class = 'container'>
                               <div class= 'position-absolute top-50 start-50 translate-middle'>
                                   <div class='alert alert-success' role='alert'>Asistente añadido </div> 
                               </div> 
                           </div>";   

            }

        

         //Enlace para añadir otro usuario
          echo "<div class = 'container d-flex justify-content-around'>                    
                        <a class='alert alert-info' href = '../View/anadirAsistente.php?anadir=" . $asistencia->acto . "'> Añadir más asistentes</a>                    
                </div>";
        
        
        }
    
    }

          
          


/**
 * Esta función muestra una tabla de asistentes, ordenados por nombre de instrumento, para un evento determinado 
 * y permite que un administrador valide su asistencia.
 * 
 * @param idActo El ID del evento para el que se muestra y valida la asistencia.
 */
function mostrarAsistenciaParaValidar($idActo){
        
       $asistencia = getAsistencia($idActo);

       $evento = mysqli_fetch_assoc(getEvento($idActo));        

       echo "<div  class='container mt-5'>
                <div class=''>     
                    <h3>Validar asistencia al acto: " . $evento["nombreActo"] . "</h3>
                </div>

        <div id = 'validar'>
       
       <table id='tabla' class='table'>\n
       <tr class='bg-info'>\n
           <th>Instrumento</th>\n
           <th>Asistentes</th>\n
           <th>Asiste</th>\n
       </tr>\n";  

       
//Mientras existan registros en la tabla asisitencia, los mostrará.
//Mostrará el instrumento, el nombre completo y las opciones de Sí o No (asiste)
while($td = mysqli_fetch_assoc($asistencia)){
        
    echo "<form class='' id='asisForm' action='validarAsistenciaAdmin.php?Validar=". $evento['idActo'] . "' method='POST'>
    <tr id='trAsistente'>\n
    <td id='tdInstrumento'>
        <input class='sinBorde' type='text' value=". $td['Instrumento'] . " readonly>
        <input type ='hidden' name='instrumentoAsis' id='instrumento' value =".  $td["idInstrumento"] . ">
    </td>\n
    <td id='tdAsistente'>
        <input class='sinBorde' type='text' value='". $td["Asistentes"]." 'readonly>
        <input type ='hidden' name='asistente' id='asistente' value =". $td["asistentes"] . ">
    </td>\n
    <td id='tdConfirmar'> 
        <input type ='hidden' name ='idActo' value =".  $evento["idActo"] . ">
        <input class= 'btn btn-outline-success' type='submit' name='Si' id='asiste' value='Sí' >\t
        <input class= 'btn btn-outline-danger' type='submit' name='No' id='noAsiste' value='No' >\t                     
    </td>\n
   </tr>\n
   </form>\n";

 
     
} 
echo " </table>\n
   
   </div>
</div>";

echo "<div class='container text-end'>
               <a href = '../View/anadirAsistente.php?anadir=" . $evento['idActo'] . "'>+ Añadir asistente</a>
           </div>";
            
}



/**
 * Esta función valida la asistencia a un evento y guarda el registro de asistencia si no se ha
 * confirmado previamente. Los usuario validados de borran de la tabla "asisitencia" y se registran en la tabla "asistenciaConfirmada"
 */
function validarAsistencia(){ 
      
    //Si el usuario es marcado como asistente
    if(isset($_POST["Si"])){  

        $acto = $_POST["idActo"] ;
        $asistente= $_POST["asistente"];
        $instrumento = $_POST["instrumentoAsis"];

        $asistencia = new Asistencia($acto, $asistente, $instrumento);

        //Se comprueba si ya está registrado ese usuario como asisitente confirmado
        $asis = comprobarAsistenciaValidada($asistencia->acto, $asistencia->asistente);

            while($linea = mysqli_fetch_assoc($asis)){
    
                $asist = $linea ['asistentes'];
            }

        if (!isset($asist)) {

        //Se borran los disitintos datos en la tabla asistencia
        borrarAsistencia($asistencia->acto, $asistencia->asistente, $asistencia->instrumento);

        //Se guardan los disitintos datos en la tabla asistenciaConfirmada
        guardarAsistenciaValidada($asistencia->acto, $asistencia->asistente, $asistencia->instrumento);

             echo "<div class = 'container'>
                     <div class= 'position-absolute top-50 start-50 translate-middle'>
                         <div class='alert alert-success' role='alert'> Asiste </div> 
                     </div> 
                 </div>";   

      

        }else{

            echo "<div class = 'container'>
                    <div class= 'position-absolute top-50 start-50 translate-middle'>
                        <div class='alert alert-danger' role='alert'> LA ASISTENCIA YA HABÍA SIDO CONFIRMADA </div>
                    </div>
                </div>";
        }   

        //Si el usuario no es marcado como asistente
        }else if(isset($_POST["No"])){

        $acto = $_POST["idActo"] ;
        $asistente= $_POST["asistente"];
        $instrumento = $_POST["instrumentoAsis"];

        $asistencia = new Asistencia($acto, $asistente, $instrumento);

        //Se borran los disitintos datos en la tabla asistencia (prevista)
        borrarAsistencia($asistencia->acto, $asistencia->asistente, $asistencia->instrumento);

        //Se borran los disitintos datos en la tabla asistencia (si ya había sido confirmada)
        borrarAsistenciaValidada($asistencia->acto, $asistencia->asistente, $asistencia->instrumento);               
    
            
            echo "<div class = 'container'>
                     <div class= 'position-absolute top-50 start-50 translate-middle'>
                         <div class=' container alert alert-danger' role='alert'> No asiste </div>
                     </div> 
                 </div>" ;      
    }


}



/**
 * La función muestra la asistencia esperada para un evento dado.
 * 
 * @param idActo El parámetro idActo es una variable que representa el ID de un evento o actividad para
 * el que queremos recuperar la asistencia esperada.
 */   
function asistenciaPrevistaEvento($idActo){

        $asistencia = getAsistencia($idActo);
    
        while($td = mysqli_fetch_assoc($asistencia)){ 
            
           echo "<tr>\n
             <td>" . $td['Instrumento'] . "</td>\n
             <td>" . $td['Asistentes'] . "</td>\n 
             </tr>\n";
        
         }
    
}

/**
 * La función muestra datos de asistencia validados para un evento determinado.
 * 
 * @param idActo El parámetro idActo es un identificador de un evento o actividad
 * específica para la cual se valida la asistencia. Se utiliza como entrada a la función
 * getAsistenciaValidada() para recuperar los datos de asistencia validados para ese evento. La función
 * asistenciaValidada() luego muestra la asistencia ya confirmada por el administrador.
 */
function asistenciaValidada($idActo){

    $asistencia = getAsistenciaValidada($idActo);        

    while($td = mysqli_fetch_assoc($asistencia)){ 
        
       echo "<tr>\n
         <td>" . $td['Instrumento'] . "</td>\n
         <td>" . $td['Asistentes'] . "</td>\n 
         </tr>\n";
    
     }

}


/**
 * Esta función confirma la asistencia de un usuario a un evento y muestra un mensaje de éxito o error
 * según corresponda.
 */  
function confirmarAsistenciaUser(){
    
        $asistente = $_SESSION["idPersona"];
        $instrumento = $_SESSION['instrumento'];     
    
    //Si el usuario indica que va a asistir al evento
    if (isset($_GET["Si"])){       
    
            $acto= $_GET["Si"];
            
            $evento = getEvento($acto);
    
            while($td = mysqli_fetch_assoc($evento)){
    
                $nombre = $td ['nombreActo'];
            }

        
            $asistencia = new Asistencia($acto, $asistente, $instrumento);

            //Se comprueba si ya está registrado ese usuario como asisitente previsto
            $asis = comprobarAsistencia($asistencia->acto, $asistencia->asistente);

            while($linea = mysqli_fetch_assoc($asis)){
    
                $asist = $linea ['asistentes'];
            }

        //Si no está registrado aún    
        if (!isset($asist)) {

            //Se guardan los disitintos datos en la tabla asistencia
            guardarAsistencia($asistencia->acto, $asistencia->asistente, $asistencia->instrumento);

            echo "<div class = 'container'>
                    <div class= 'position-absolute top-50 start-50 translate-middle'>
                        <div class='alert alert-success' role='alert'> Asistencia confirmada al acto \"" . $nombre . "\": Asistiré </div>
                    </div>
                </div>";

        //Si ya está registrado   
        }else{

            echo "<div class = 'container'>
                    <div class= 'position-absolute top-50 start-50 translate-middle'>
                        <div class='alert alert-danger' role='alert'> LA ASISTENCIA YA HABÍA SIDO CONFIRMADA </div>
                    </div>
                </div>";
        }   
        
    } 
    

}
   

/**
 * Esta función elimina el registro de asistencia de un usuario para un evento específico y
 * muestra un mensaje que indica si la asistencia fue confirmada o no.
 */
function borrarAsistenciaUser(){

    $asistente = $_SESSION["idPersona"];
    $instrumento = $_SESSION['instrumento']; 

    if (isset($_GET["No"])){

        $acto= $_GET["No"];
      
        $evento = getEvento($acto);

        while($td = mysqli_fetch_assoc($evento)){

          $nombre = $td ['nombreActo'];
        }

        $asistencia = new Asistencia($acto, $asistente, $instrumento);

        //Se comprueba si ya está registrado ese usuario como asisitente previsto
        $asis = comprobarAsistencia( $asistencia->acto,  $asistencia->asistente);

           while($linea = mysqli_fetch_assoc($asis)){
    
            $asist = $linea ['asistentes'];

        }


        if (isset($asist)) {

            //Si ya estaba añadido (porque anteriormente se había registrado) se borra de la tabla de asistencia
            borrarAsistencia($asistencia->acto,  $asistencia->asistente, $asistencia->instrumento);   
    
    
            echo "<div class = 'container'>
                    <div class= 'position-absolute top-50 start-50 translate-middle'>
                        <div class='alert alert-danger' role='alert'> Asistencia eliminada al acto \"" . $nombre . "\". </div>
                    </div>
                </div>";

        //Si no estaba registrado, se informa de la elección pero no se realiza ninguna acción       
        }else if (!isset($asist)) {

            echo "<div class = 'container'>
                    <div class= 'position-absolute top-50 start-50 translate-middle'>
                        <div class='alert alert-warning' role='alert'> Asistencia confirmada al acto \"" . $nombre . "\": No asistiré </div>
                    </div>
                </div>";

        }   

    }   
}
    
?>
        