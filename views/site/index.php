<section id="inicio" class="contenedor-full p-0">
<?php
        $guardado=(isset($_REQUEST['guardado']) ? $_REQUEST['guardado']: false );
        if(isset($guardado)) {
            if(isset($_REQUEST['mensaje'])){
                if ($guardado==true) {
                    ?>
                    <div class="alert alert-success">
                        <p><?php echo $_REQUEST['mensaje'];?></p>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-danger">
                        <p><?php echo $_REQUEST['mensaje'];?></p>
                    </div>
                    <?php
                }
            }

        }

        ?>

  <div class="overlay">

  </div>

  <div class="logo">

    <img src="assets/img/logo-inicio.png" alt="">

  </div>

</section>

<!-- Seccion slogan -->
<section id="slogan" class="half-section">

  <div class="container">

    <div class="slogan">

        <div class="jumbotron">

            <h2 class="mb-15 color-black">"Tu residuo, tu responsabilidad"</h2>

            <p class="text-justify"> L@s ganador@s no serán quienes lleguen a la meta más rápido, esta carrera implica un dasafío mayor, trabajo en equipo vinculado a destreza física, orientación y conciencia del medio en el cual se practica la actividad.</p>

        </div>

    </div>

  </div>

</section>

<section id="requisitos" class="parallax cover-background contenedor-full full-section" style="background-image:url('assets/img/fondo.jpg');">

  <div class="container">

    <div class="row">
        <div class="col-lg-6">
            <h3 class="titulo-primario text-center">Requisitos de la carrera</h3>

              <h4 class="subtitulo">Quien participa</h4>
              <p class="text-justify"> Toda persona que cumpla los requisitos de la inscripción. La modalidad de dicha carrera se va a dar en grupos conformados por dos o cuatro personas.</p>
              <h4 class="subtitulo">¿Como ganar?</h4>
              <p class="text-justify"> Para ganar van a tener que realizar los siguientes pasos:
              <p class="text-justify"><b>Recolección de residuos en bolsas por la cantidad de integrantes</b>; si el equipo es conformado por dos personas deberán recolectar una bolsa completa. Si es de cuatro, se deberá recolectar dos bolsas completas de residuos.</p>
              <p class="text-justify"><b>Contestar las trivias que se encuentran en el camino.</b> Las mismas serán levantadas por código QR, para lo cual cada equipo deberá llevar un teléfono celular que se va a presentar al finalizar la carrera. </p>
              <p class="text-justify"><b>Tiempo de carrerar del circuito completo.</b> El equipo que menos tarda en hacer todos los pasos será el ganador</p>

              <a href="" class="btn btn-grande btn-rounded btn-carrera mt-40">Inscribíte</a>

        </div>
        <div class="col-lg-6 bardas-list">
            <h3 class="titulo-primario text-center">Premiación</h3>
            <p class="text-justify"> Todos los participantes recibirán una bolsa de tela con un kit: remera + botella de agua. Esta última, la podrán recargar en
              los distintos puestos de hidratación. De esta forma, se reducirán los vasos plásticos que se utilicen en la carrera. Además se indicarán los premios que se entregarán por categoría
              sin diferenciar en grupos etarios.</p>
            <h4 class="subtitulo">Categoria Running:</h4>
            <p class="ml-2">Equipos de cuatro personas:
              <ol>
                <li>$6000 para el equipo.</li>
                <li>$4000 para el equipo.</li>
                <li>$2800 para el equipo.</li>
              </ol>
            <p class="ml-2">Equipos de dos personas: </p>
              <ol>
                <li>$3000 para el equipo.</li>
                <li>$2000 para el equipo.</li>
                <li>$1400 para el equipo.</li>
              </ol>
            <h4 class="subtitulo">Categoria Recreativa:</h4>
            <p>Premios en especies.</p>
            <p><b>Equipos de cuatro personas: </b> tres primeros puestos. <br> <b>Equipos de dos personas: </b> tres primeros puestos</p>
        </div>
    </div>

  </div>

</section>

<!-- Seccion imagen/texto-->
<section class="contenedor-full p-0">

  <div class="container-fluid height-100">

    <div class="row height-100">

        <div class="col-lg-6 cover-background height-100" style="background-image:url('assets/img/basura.png');">
        </div>

        <div class="col-lg-6">

            <h3 class="primario text-center"></h3>
              <p class="text-justify full-section">Este evento está inspirado en la práctica del <i>Plogging </i> - término que combina dos palabras en inglés: correr y recoger-, y se trata de la acción de recoger residuos mientras se corre.
                Son muchas las carreras deportivas que buscan concientizar sobre el reciclaje y el cuidado ambiental en todo el mundo ya que, son esos mismos eventos los que en la mayoría de las ocasiones generan acumulación de residuos y micro-basurales.
                <i>“Desafío por la barda”</i> integra tres aspectos claves en la relación ambiente - deporte - tecnología: la protección del ecosistema natural de la ciudad con la actividad deportiva en el marco de entretenidas trivias, con las que los corredores se
              </p>

        </div>

    </div>

  </div>

</section>

<section id="contacto" style="background-image:url('assets/img/fondo.jpg');" class="full-section">

  <div class="container">

    <div class="row">

      <div class="col-xs-12 col-md-5">

        <div class="clock-container mt-ten color-black">

          <span class="clock" id="demo"></span>
          <span class="clocktext mt-30">Dias | Horas | Minutos</span>

        </div>

      </div>

        <div class="col-xs-12 col-md-7">
          <h4 class="titulo-primario" id="contactos">Contactanos</h3>
            <form>
              <div class="form-group">
                <input type="email" class="input-db" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              </div>
              <div class="form-group">
                <textarea class="input-db" id="exampleInputComentario" placeholder="Ingrese su comentario..." rows="3"></textarea>
              </div>
              <a href="" class="btn btn-grande btn-rounded btn-carrera mt-10">Enviar</a>
            </form>
        </div>

    </div>

  </div>

</section>
