<?php

/* Importa el archivo "headerIndex.php" que es el que contiene el código necesario para la cabecera. */
require_once("Parts/headerIndex.php");
?>

<!-- Este bloqeu es un "div" que contiene un carrusel de imágenes y sus respectivas descripciones que , juntos,
confoman la página inicial de la aplicación. En ella se muestra un resumen de las características y funciones de la aplicación. -->
<div class="container">
  
  <div id="carouselExampleDark" class="carousel carousel-dark slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="10000">
        <img src="Public\img\portada.png" class="d-block w-100">
        <div class="carousel-caption d-none d-md-block">
          <h5>MusicList</h5>
          <p>Tu herramienta para la gestión de los diferentes eventos.</p>
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="2000">
        <img src="Public\img\calendario.png" class="d-block w-100">
        <div class="carousel-caption d-none d-md-block">
          <h5>Crea y gestiona los diferentes eventos.</h5>
        </div>
      </div>
      <div class="carousel-item">
        <img src="Public\img\list.png" class="d-block w-100">
        <div class="carousel-caption d-none d-md-block">
          <h5>Consulta los eventos realizados</h5>
        </div>
      </div>
      <div class="carousel-item">
        <img src="Public\img\instrumentos.png" class="d-block w-100">
        <div class="carousel-caption d-none d-md-block">
          <h5>Gestiona la plantilla para cada evento</h5>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
    
</div>


<?php
/* Importa el archivo "footer.php" que es el que contiene el código necesario para el pie. */
require_once("Parts/footer.php");
?>


    