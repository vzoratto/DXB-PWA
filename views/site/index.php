<?php use yii\helpers\Url; ?>

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
  $persona=new \app\models\Persona();
  $inscrito=$persona->inscrito();



  ?>

        <div class="overlay">

        </div>

        <div class="logo wow fadeIn">

          <img src="assets/img/logo-inicio.png" alt="">

          <div class="wow fadeIn btn-dual text-center mt-ten relative">

            <?php if ($inscrito==0) {
              // code...

            echo '<a href="'.Url::to(["/site/registro"]).'" class="btn btn-white btn-rounded no-margin-lr">Regístrate</a>';

          } elseif($inscrito==2) {

            echo '<a href="'.Url::to(["/inscripcion"]).'" class="btn btn-white btn-rounded no-margin-lr">Inscribíte</a>';

          }elseif ($inscrito==1){
                echo '<a href="'.Url::to(["/inscripcion"]).'" class="btn btn-white btn-rounded no-margin-lr">Modificar datos de inscripción</a>';
            }; ?>
            <a href="#premios" target="_blank" class="btn btn-transparent-white btn-rounded margin-20px-lr sm-margin-5px-top">Conocé más</a>
          </div>

        </div>

        </section>

        <!-- Seccion slogan -->
        <section class="half-section">

        <div class="container">

          <div class="slogan">

              <div class="jumbotron wow fadeIn">

                  <h2 class="mb-15 color-black">"Tu residuo, tu responsabilidad"</h2>

                  <p class="text-justify"> L@s ganador@s no serán quienes lleguen a la meta más rápido, esta carrera implica un dasafío mayor, trabajo en equipo vinculado a destreza física, orientación y conciencia del medio en el cual se practica la actividad.</p>

              </div>

          </div>

        </div>

        </section>

        <section id="premios" class="parallax cover-background contenedor-full full-section" style="background-image:url('assets/img/fondo.jpg');">

        <div class="container">

          <div class="row">
              <div class="col-xs-12 col-md-6">
                  <h3 class="titulo-primario text-center">Requisitos de la carrera</h3>

                    <h4 class="subtitulo">Quien participa</h4>
                    <p class="text-justify"> Toda persona que cumpla los requisitos de la inscripción. La modalidad de dicha carrera se va a dar en grupos conformados por dos o cuatro personas.</p>
                    <h4 class="subtitulo">¿Como ganar?</h4>
                    <p class="text-justify"> Para ganar van a tener que realizar los siguientes pasos:
                    <p class="text-justify"><b>Recolección de residuos en bolsas por la cantidad de integrantes</b>; si el equipo es conformado por dos personas deberán recolectar una bolsa completa. Si es de cuatro, se deberá recolectar dos bolsas completas de residuos.</p>
                    <p class="text-justify"><b>Contestar las trivias que se encuentran en el camino.</b> Las mismas serán levantadas por código QR, para lo cual cada equipo deberá llevar un teléfono celular que se va a presentar al finalizar la carrera. </p>
                    <p class="text-justify"><b>Tiempo de carrerar del circuito completo.</b> El equipo que menos tarda en hacer todos los pasos será el ganador</p>

                    <div class="row sm-center">

                      <?php if ($inscrito==0) {
                        // code...

                      echo '<a href="'.Url::to(["/site/registro"]).'" class="btn btn-grande btn-rounded btn-carrera mt-20 mb-80">Regístrate</a>';

                    } elseif($inscrito==2){

                      echo '<a href="'.Url::to(["/inscripcion"]).'" class="btn btn-grande btn-rounded btn-carrera mt-20 mb-80">Inscribíte</a>';

                    }elseif ($inscrito==1){
                          echo '<a href="'.Url::to(["/inscripcion/editar"]).'" class="btn btn-grande btn-rounded btn-carrera mt-20 mb-80">Modificar datos de inscripción</a>';
                      }; ?>
                      
                    </div>

              </div>
              <div class="col-xs-12 col-md-6 bardas-list">
                  <h3 class="titulo-primario text-center">Premiación</h3>
                  <p class="text-justify"> Todos los participantes recibirán una bolsa de tela con un kit: remera + botella de agua. Esta última, la podrán recargar en
                    los distintos puestos de hidratación. De esta forma, se reducirán los vasos plásticos que se utilicen en la carrera. Además se indicarán los premios que se entregarán por categoría
                    sin diferenciar en grupos etarios.</p>
                  <h4 class="subtitulo">Categoria Running:</h4>
                  <p class="ml-2 sm-center">Equipos de cuatro personas:
                    <ol>
                      <li>$6000 para el equipo.</li>
                      <li>$4000 para el equipo.</li>
                      <li>$2800 para el equipo.</li>
                    </ol>
                  <p class="ml-2 sm-center">Equipos de dos personas: </p>
                    <ol>
                      <li>$3000 para el equipo.</li>
                      <li>$2000 para el equipo.</li>
                      <li>$1400 para el equipo.</li>
                    </ol>
                  <h4 class="subtitulo">Categoria Recreativa:</h4>
                  <p><b>Equipos de cuatro personas: </b> tres primeros puestos. <br> <b>Equipos de dos personas: </b> tres primeros puestos</p>
              </div>
          </div>

        </div>

        </section>

        <section id="colaboradores" class="full-section">

        <div class="container">

          <div class="row">

            <div class="col-xs-12 col-md-4 colabora">

              <h4 class="subtitulo mt-ten sub-auspicia sm-center"> Auspicia </h4>

              <img class="provincia" src="assets/img/colabora/provincia.png" alt="">

            </div>

            <div class="col-xs-12 col-md-4 colabora">

              <h4 class="subtitulo mt-ten sm-center"> Organiza </h4>

              <a href="https://www.uncoactiva.com/" target="_blank"> <img class="largo" src="assets/img/colabora/unco-activa.png" alt=""> </a>

              <img class="redondo" src="assets/img/colabora/unco.png" alt="">

            </div>

            <div class="col-xs-12 col-md-4 colabora">

              <h4 class="subtitulo mt-ten sm-center"> Participa </h4>

              <img class="largo" src="assets/img/colabora/facias.png" alt="">

              <img class="redondo" src="assets/img/colabora/fai.png" alt="">

            </div>

          </div>

        </div>


        </section>

        <!-- Seccion imagen/texto-->
        <section id="reglamento" class="contenedor-full p-0">

        <div class="container-fluid height-100">

          <div class="row height-100">

              <div class="col-md-6 cover-background height-100 sm-hidden" style="background-image:url('assets/img/basura.png');">
              </div>

              <div class="col-md-6 full-section">

                <h3 class="titulo-primario ml-5 mr-5"> Reglamento</h3>

                <p class="subtitulo mt-25 ml-5 mr-5">Pellentesque elementum</p>
                <p class="ml-5 mr-5">libero sit amet accumsan hendrerit. Duis vitae nulla felis. Duis
                eu fermentum velit. Etiam quis lectus dui. Nam interdum porta bibendum. Morbi efficitur fermentum nunc. Suspendisse
                rhoncus ornare lobortis. Mauris et ligula vel nunc efficitur varius nec eu tellus. Morbi quam sapien, viverra
                ut scelerisque quis, sollicitudin placerat odio.</p>

                <p class="subtitulo mt-25 ml-5 mr-5">Pellentesque elementum</p>
                <p class="ml-5 mr-5">libero sit amet accumsan hendrerit. Duis vitae nulla felis. Duis
                eu fermentum velit. Etiam quis lectus dui. Nam interdum porta bibendum. Morbi efficitur fermentum nunc. Suspendisse
                rhoncus ornare lobortis. Mauris et ligula vel nunc efficitur varius nec eu tellus. Morbi quam sapien, viverra
                ut scelerisque quis, sollicitudin placerat odio.</p>

                <div class="row text-center">
                  <a href="<?php echo Url::to(['/site/reglamento']); ?>" class="btn btn-grande btn-rounded btn-carrera mt-20 mb-80">Reglamento completo</a>
                </div>

              </div>

          </div>

        </div>

        </section>

        <section id="contacto" style="background-image:url('assets/img/fondo.jpg');" class="full-section">

        <div class="container">

          <div class="row">

            <div class="col-xs-12 col-md-5">

              <div class="clock-container mt-ten mb-50 color-black">

                <span class="clock" id="demo"></span>
                <span class="clocktext mt-30">Dias | Horas | Minutos</span>

              </div>

            </div>

              <div class="col-xs-12 col-md-7">
                <h4 class="titulo-primario" id="contacto">Contactanos</h3>
                  <form>
                    <div class="form-group">
                      <input type="email" class="input-db" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail *">
                    </div>
                    <div class="form-group">
                      <input type="text" class="input-db" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Asunto *">
                    </div>
                    <div class="form-group">
                      <textarea class="input-db" id="exampleInputComentario" placeholder="Ingrese su mensaje... *" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-grande btn-rounded btn-carrera mt-10">Enviar</button>
                  </form>
              </div>

          </div>

        </div>

        </section>
        <section id="footer">
          <div class="container">
            <div class="row text-center text-xs-center text-sm-left text-md-left">
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                <ul class="list-unstyled list-inline social text-center">
                  <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                <p><a href="https://www.uncoactiva.com/" target="_blank">Unco Activa</a></p>
              </div>
            </div>
          </div>
        </section>
