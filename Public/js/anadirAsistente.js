
$(document).ready(function(){
     var nombreCompleto = $('#nombreCompleto');
     

     /*Elección del instrumento en el select y, dependiendo de la opción elegida, 
     * se muestran los usuarios registrados con ese instrumento en el otro select.
     * Esto se realiza para mandar el instrumento escogido e interactuar con la base de datos.
     */
     $('#instrumentos').change(function(){
       var instrumento = $(this).val(); 

       //Si el select intrumentos tiene una opción seleccionada.
       if(instrumento !== ''){ 

         $.ajax({
           data: {instrumento:instrumento}, 
           dataType: 'html', 
           type: 'POST', 
           url: '../Controller/asistenciaController.php' 
         }).done(function(data){              

             nombreCompleto.html(data);            
             nombreCompleto.prop('disabled', false); 
         });         

        // Si no se escoge una opción válida.
       }else{ 
         nombreCompleto.val(''); 
         nombreCompleto.prop('disabled', true); 
       }    
     });

   });
