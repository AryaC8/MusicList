<?php 

/* Incluye el archivo `asistenciaController.php` del directorio `Controller`. */
require_once("../Controller/asistenciaController.php");


/* Este código está generando una tabla con información de asistencia para un evento. La
variable `$filename` se utiliza para establecer el nombre del archivo que se descargará
cuando el usuario haga clic en el botón de descarga. Las funciones de `encabezado` se
utilizan para establecer el tipo de contenido y la disposición del archivo. Las sentencias
`if` comprueban qué variable está configurada `Asistencia` o `AsistenciaValidada` y 
muestran un encabezado con el nombre del evento. Finalmente, se
llama a las funciones `asistenciaPrevistaEvento` o `asistenciaValidada` para generar la
tabla de asistencia en base al parámetro `idActo` pasado en la variable `$_GET['evento']`. */

         $filename = "Asistencia. Fecha: " . date('d-m-Y') . ".xls";

             header("Content-Type: application/xls");
             header("Content-Encoding:utf8");
             header("Content-Disposition: attachment; filename=".$filename);
             header("Pragma: no-cache");
             header("Expires: 0");

 
        if(isset($_GET["Asistencia"])){

          echo "<div class='container mt-5'>  
                  <div class=''>     
                    <h3>Asistencia prevista al acto: " . $_GET['evento'] . "</h3>
                  </div>"; 

        }else if(isset($_GET["AsistenciaValidada"])){
              
          echo "<div class='container mt-5'>  
                  <div class=''>     
                    <h3>Asistencia confirmada al acto: " . $_GET['evento'] . "</h3>
                  </div>"; 

        }

  ?>
                     
          
          <table class="table">
            <tr class="bg-info">
                <th>Instrumento</th>
                 <th>Nombre</th>
             </tr> 
            
             <?php          

              if(isset($_GET["Asistencia"])){

                asistenciaPrevistaEvento($_GET['idActo']);

              }else if(isset($_GET["AsistenciaValidada"])){
              
                asistenciaValidada($_GET['idActo']); 

              }
         
             ?>    
           </table>
        






