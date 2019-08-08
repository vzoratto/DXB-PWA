<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Persona;
$userLogueado=Yii::$app->user; // Obtenemos el objeto del usuario logeado
$persona=new \app\models\Persona();
$inscrito=$persona->inscrito();


 ?>
<div id="not-full"></div>
<section id="inicio" class="contenedor-full p-0">
<?php
  $guardado=(isset($_REQUEST['guardado']) ? $_REQUEST['guardado']: false );
  if(isset($guardado)) {
      if(isset($_REQUEST['mensaje'])){
          if ($guardado==true) {
              ?>
              <div class="alert alert-index alert-success">
                <button type="button" class="close ml-20" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span><?php echo $_REQUEST['mensaje'];?></span>
              </div>
              <?php
          } else {
              ?>
              <div class="alert alert-index alert-danger">
                <button type="button" class="close ml-20" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span><?php echo $_REQUEST['mensaje'];?></span>
              </div>
              <?php
          }
      }

  }

  ?>

        <div class="overlay">

        </div>


          <?php if (Yii::$app->user->isGuest) {
            // code...
          echo '<div class="inicio-sesion">';
          echo '<a href="'.Url::to(["site/login"]).'" class="">¿Ya tenes usuario? Inicia sesión aquí</a>';
          echo '</div>';
        }
         ?>



        <div class="logo wow fadeIn">

          <img src="assets/img/logo-inicio.png" alt="logo inicio">

          <div class="wow fadeIn btn-dual text-center mt-ten relative">

            <?php if (Yii::$app->user->isGuest) {
              // code...

            echo '<a href="'.Url::to(["/site/registro"]).'" class="btn btn-white btn-rounded no-margin-lr">Regístrate</a>';

          } else {
            if(!Persona::findOne(['idUsuario' => $_SESSION['__id']])){
              $idRol = $userLogueado->identity->idRol;
              if ($idRol == 1  || $idRol == 4 ){ // Si es gestora o administradora
                echo '<a href="'.Url::to(["/inscripcion"]).'" class="btn btn-white btn-rounded no-margin-lr">Inscribíte</a>';
              }
            }
          }; ?>
            <a href="#premios" class="btn btn-transparent-white btn-rounded margin-20px-lr sm-margin-5px-top">Conocé más</a>
          </div>

        </div>

        </section>

        <!-- Seccion slogan -->
        <section class="half-section">

        <div class="container">

          <div class="slogan">

              <div class="jumbotron wow fadeIn">

                  <h2 class="mb-15 color-black">"Tu residuo, tu responsabilidad"</h2>

                  <p class="text-justify"> L@s ganador@s no serán quienes lleguen a la meta más rápido, esta carrera implica un desafío mayor, trabajo en equipo vinculado a destreza física, orientación y conciencia del medio en el cual se practica la actividad.</p>

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

                      <?php if (Yii::$app->user->isGuest) {
                        // code...

                      echo '<a href="'.Url::to(["/site/registro"]).'" class="btn btn-grande btn-rounded btn-carrera mt-20 mb-80">Regístrate</a>';

                    } if($inscrito==2) {

                      echo'<a href="'.Url::to(["/inscripcion"]).'" class="btn btn-grande btn-rounded btn-carrera mt-20 mb-80">Inscribíte</a>';

                    }; ?>

                    </div>

              </div>
              <div class="col-xs-12 col-md-6 bardas-list">
                  <h3 class="titulo-primario text-center">Premiación</h3>
                  <p class="text-justify"> Todos los participantes recibirán una bolsa de tela con un kit: remera + botella de agua. Esta última, la podrán recargar en
                    los distintos puestos de hidratación. De esta forma, se reducirán los vasos plásticos que se utilicen en la carrera. Además se indicarán los premios que se entregarán por categoría
                    sin diferenciar en grupos etarios.</p>
                  <h4 class="subtitulo">Categoria Running:</h4>
                  <p class="ml-2 sm-center"><b>Equipos de cuatro personas:</b></p>
                    <ol>
                      <li>$6000 para el equipo.</li>
                      <li>$4000 para el equipo.</li>
                      <li>$2800 para el equipo.</li>
                    </ol>
                  <p class="ml-2 sm-center"><b>Equipos de dos personas: </b></p>
                    <ol>
                      <li>$3000 para el equipo.</li>
                      <li>$2000 para el equipo.</li>
                      <li>$1400 para el equipo.</li>
                    </ol>
                  <h4 class="subtitulo">Categoria Recreativa:</h4>
                  <p><b>Equipos de cuatro personas: </b> tres primeros puestos. <br> <b>Equipos de dos personas: </b> tres primeros puestos</p>
                  <h4 style="color:#ea9242; font-size:17px">PREMIOS de Natural Shanti</h4>
                  <ol>
                      <li style="font-size: 14px">Dos bolsas con productos de Natural Shanti para cada uno de los participantes del equipo.</li>
                      <li style="font-size: 14px">Un voucher por un desayuno + un acompañante para cada integrante del equipo.</li>
                      <li style="font-size: 14px">Una bolsa con productos de Natural Shanti para cada uno de los participantes del equipo.</li>
                  </ol>
              </div>
          </div>

        </div>

        </section>

        <section id="colaboradores" class="full-section">

        <div class="container">

          <div class="row">

            <div class="col-xs-12 col-md-4 colabora">

              <h4 class="subtitulo mt-ten sub-auspicia sm-center"> Auspicia </h4>

              <a href="http://neuquen.gov.ar/" target="_blank"> <img class="provincia" src="assets/img/colabora/provincia.png" alt=""> </a>

            </div>

            <div class="col-xs-12 col-md-4 colabora">

              <h4 class="subtitulo mt-ten sm-center"> Organiza </h4>

              <a href="https://www.uncoma.edu.ar/" target="_blank"> <img class="width-20" src="assets/img/colabora/rsu.png" alt="Programa de compromiso social universitario"> </a>

              <a href="https://www.uncoactiva.com/" target="_blank"> <img class="width-50" src="assets/img/colabora/unco-activa.png" alt="Unco activa"> </a>

              <a href="https://www.facebook.com/pg/bienestaruncoma" target="_blank"> <img class="width-20" src="assets/img/colabora/bienestar.png" alt="Bien Estar UNCOMA"> </a>

            </div>

            <div class="col-xs-12 col-md-4 colabora">

              <h4 class="subtitulo mt-ten sm-center"> Participa </h4>

                <a href="http://faciasweb.uncoma.edu.ar/" target="_blank"> <img class="largo" src="assets/img/colabora/facias.png" alt="Facultad de ciencias del ambiente y la salud"> </a>

                <a href="http://faiweb.uncoma.edu.ar/" target="_blank"> <img class="redondo" src="assets/img/colabora/fai.png" alt="Facultad de informatica"> </a>

            </div>

          </div>

        </div>


        </section>

        <!-- Seccion imagen/texto-->
        <section id="reglamento" class=" p-0">

        <div class="container-fluid height-100">

          <div class="row ">

              <div class="col-md-6 cover-background height-100vh sm-hidden" style="background-image:url('assets/img/basura.png');">
              </div>

              <div class="col-md-6 pt-50 pb-0 full-section">

                <h3 class="titulo-primario ml-5 mr-5"> Reglamento</h3>

                <p class="subtitulo mt-25 ml-5 mr-5">Participantes</p>
                <p class="ml-5 mr-5">EQUIPOS. Tanto en 8k como en 4km. <br>
                Conformación de equipos: Se deberá asignar el rol de “capitan” a alguno de los integrantes del equipo, ya sea de dos personas o 4 personas. La inscripción por la web deberá realizarla primero el “capitan” y luego el resto de los miembros que compongan el equipo. El sistema solicitará el DNI del capitán para vincularlos en forma directa con su “capitan”.
                Para aquellos corredores que no cumplan 18 años a la fecha de la carrera, deberán presentar al momento de la acreditación autorización de padre/madre o tutor para poder participar y copia de la ficha de inscripción firmada por el participante y por el padre.<br><b>Nota Importante</b>: no se permiten corredores menores a 12 años.
                .</p>

                <p class="subtitulo mt-25 ml-5 mr-5">Reglas generales</p>
                <p class="ml-5 mr-5">Al inscribirse, el participante acepta el presente reglamento y declara:<br><br>
                a) Saber incluso que habrá lugares a los que no pueda accederse con vehículos, con lo cual la atención inmediata es limitada.<br>
                b) Conocer las características del terreno y los riesgos posibles de lesiones traumatológicas como torceduras, esguinces, incluso fracturas. Y que por razones de seguridad, la organización priorizará la atención y evacuación de las emergencias y urgencias médicas, considerándose como tales a aquellos casos que puedan evolucionar en riesgo de muerte, pudiendo entonces demandar más tiempo la atención de lesiones como las antes descriptas.<br>
                c) Eximir a los Organizadores, Municipios, los Propietarios de las tierras por las que pase la carrera y los Patrocinantes de toda responsabilidad por accidentes personales; daños y/o pérdidas de objetos que pudiera ocurrirle antes, durante o después de su participación en la prueba.
</p>

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
            <div class="site-contact"></div>
              <div class="col-xs-12 col-md-7 no-label">
                <h4 class="titulo-primario" id="contacto">Contactanos</h3>
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <div class="form-group">
                       <?= $form->field($model, 'email')->textInput(['class'=>'input-db','id'=>'exampleInputEmail1','aria-describedby'=>'emailHelp',' placeholder'=>'E-mail *']) ?>
                    </div>
                    <div class="form-group">
                       <?= $form->field($model, 'subject')->textInput(['class'=>'input-db','id'=>'exampleInputEmail1','aria-describedby'=>'emailHelp',' placeholder'=>'Asunto *']) ?>
                    </div>
                    <div class="form-group">
                       <?= $form->field($model, 'body')->textarea(['class'=>'input-db','id'=>'exampleInputComentario','placeholder'=>'Ingrese su mensaje... *','rows' => 3]) ?>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-grande btn-rounded btn-carrera mt-10', 'name' => 'contact-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
              </div>
            </div>
          </div>

        </div>
        <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
        <div class="alert alert-success" align="center">
        Gracias por contactarnos. Responderemos en breve :)
        </div>
        <?php endif; ?>
        </section>
        <section id="footer">
          <div class="container">
            <div class="row text-center text-xs-center text-sm-left text-md-left">
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                <ul class="list-unstyled list-inline social text-center">
                  <li class="list-inline-item"><a href="https://www.facebook.com/bienestaruncoma/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  <li class="list-inline-item"><a href="https://twitter.com/prensaunco" target="_blank"><i class="fa fa-twitter"></i></a></li>
                  <li class="list-inline-item"><a href="https://www.instagram.com/sbucomahue/" target="_blank"><i class="fa fa-instagram"></i></a></li>
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
