<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Personaemergencia */
/* @var $form yii\widgets\ActiveForm */
?>


<!-- vista del tab reglamento-->
<div class="reglamento">




            <div class="titulo-primario text-center">
                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>
            </div>
            <div class="subtitulo text-center">
                <h4><i>Desafio por las bardas</i></h4>
            </div>

            <p class="subtitulo mt-25">A) PARTICIPANTES</p>
            <p>EQUIPOS. Tanto en 8k como en 4km.
                Conformación de equipos: Se deberá asignar el rol de “capitan” a alguno de los integrantes del equipo, ya sea de dos personas o 4 personas. La inscripción por la web deberá realizarla primero el “capitan” y luego el resto de los miembros que compongan el equipo. El sistema solicitará el DNI del capitán para vincularlos en forma directa con su “capitan”.
                Nota Importante: no se permiten corredores menores a 12 años.  Para aquellos corredores que no cumplan 18 años a la fecha de la carrera, deberán presentar al momento de la acreditación autorización de padre/madre o tutor para poder participar y copia de la ficha de inscripción firmada por el participante y por el padre.
            </p>

            <p class="subtitulo mt-25">B) PREMIACIÓN</p>
            <p>Prueba de 8 km competitiva<br><br>
                Premios de tipo monetario
                - Equipos de cuatro personas:tres primeros puestos<br>
                1° premio: $6000 para el equipo.<br>
                2° premio: $4000 para el equipo.<br>
                3° premio: $2800 para el equipo.<br><br>

                - Equipos de dos personas: tres primeros puestos<br>
                1° premio: $3000 para el equipo.<br>
                2° premio: $2000 para el equipo.<br>
                3° premio: $1400 para el equipo.<br><br>

                Prueba Recreativa: 4k.<br>
                Premios en especies<br>
                - Equipos de cuatro personas: tres primeros
                puestos<br>
                - Equipos de dos personas: tres primeros pues-
                tos
            </p>

            <p class="subtitulo mt-25">C) REMERA DE LA COMPETENCIA Y NUMERO IDENTIFICATORIO</p>
            <p>La remera de corredor será de uso obligatorio con el número abrochado al frente.</p>

            <p class="subtitulo mt-25">D) SERVICIOS, ASISTENCIA, HIDRATACION y CONTROLES</p>
            <p>En un punto intermedio del recorrido y en la llegada se montarán puestos de asistencia e hidratación.
                A lo largo del recorrido se establecerán controles de paso de los corredores y a su vez estarán con remeras con el código QR que deberán escanear para dar respuestas a las trivias.
            </p>

            <p class="subtitulo mt-25">E) FORMATO DE CLASIFICACIÓN</p>
            <p>Los participantes deberán llegar juntos a la llegada y cumplir los siguientes objetivos:
                Realizar el recorrido en el menor tiempo posible.
                Tendrán que responder 15 trivias referidas al cuidado ambiental en el caso de los 8k (mínimo para ganar deben contestar más del 50%)<br><br>
                Recolección de residuos en bolsas por cantidad de integrantes: <br>(a) Equipos de 2 personas: recolectar una bolsa completa de residuos. <br>(b) Equipos de 4 personas: recolectar dos bolsas completas de residuos.<br>
                En la acreditación se entregarán los requisitos que deben completar en competencia.
                En caso que un equipo no complete las bolsas ni las trivias correctas no será clasificado, ya que esta competencia tiene como objetivo trabajar sobre la conciencia ambiental, más que la competencia deportiva.
                No pueden utilizar vehículos ni accesorios para transportar las bolsas.
                No pueden ser asistidos por otras personas en competencia (fair play)

            </p>

            <p class="subtitulo mt-25">F) REGLAS GENERALES PARA LOS PARTICIPANTES</p>
            <p>Es responsabilidad del participante estar bien preparado para la prueba. Esto es, gozar de buena salud en general, así como tener un nivel aceptable de preparación. La inscripción en una prueba no asegura ni cubre esta responsabilidad.
                La organización recomienda que todos los participantes se realicen un control médico previo a la carrera para asegurarse estar apto para el evento.
                Es obligatorio completar la ficha de inscripción publicada en forma on line en el sitio oficial de la carrera.
                La organización, a través de los fiscales autorizados, se reserva el derecho de interrumpir la participación de aquellos competidores que por su condición se considere están poniendo en riesgo su integridad física, en caso de ser indicado, es obligación del participante hacer caso a la misma. De no respetarse será descalificado y la responsabilidad corre por cuenta del propio participante.
                La organización dispondrá ambulancias y enfermeros para la asistencia médica extra hospitalaria a quienes lo necesiten. Cada corredor está en conocimiento de las posibles consecuencias de la práctica de una actividad de este tipo, deberá por lo tanto asumir y ser responsable de cualquier gasto relacionado a emergencias médicas, salvo aquellos cubiertos por el seguro de corredor y la atención de la emergencia en terreno ya sea con la ambulancia, socorristas, enfermeros o médicos de la organización de la carrera. En caso de ser necesario, para continuar con los primeros auxilios, serán trasladados al hospital más cercano. Es fundamental que cada corredor al completar la ficha de inscripción detalle en “Observaciones” los datos de su cobertura médica y un teléfono de urgencia.<br>
                El participante tiene la obligación de conocer y respetar estas reglas de competición, así como las normas de circulación y las instrucciones de los responsables de cada prueba.
                El participante tiene la obligación de conocer, defender y respetar el medio ambiente en el que se realiza el evento. La participación en la prueba no exime al participante de esta obligación. El mal trato o la falta de respeto hacia el medio puede ser motivo de descalificación pudiendo llegarse a la expulsión de la competición general.
                El participante que abandona la competición está obligado a quitarse el número y comunicar a los jueces, fiscales o banderilleros su abandono, entregando el troquel del respectivo número.
                En la charla técnica, previa a largada, se brindará una explicación por donde será el recorrido. En caso de extravío, por no ver una cinta, o no prestar atención a los senderos o indicaciones por parte de la organización, los corredores son responsables de volver al camino y retomar el recorrido. Ante cualquier reclamo por extravío la organización no se hace responsable.
                El recorrido podrá ser modificado antes o incluso durante el desarrollo mismo de la carrera atendiendo a razones de seguridad de los participantes u otras circunstancias que a consideración de la organización lo demanden. El caso de que la decisión sea tomada antes de la largada los corredores serán notificados. En caso de que la decisión sea tomada durante el desarrollo de la carrera, los participantes serán informados en el puesto de control anterior a la modificación. La organización no se hará responsable de cualquier tipo de reclamo por parte de los participantes por esta causa.
                Las imágenes que se obtengan en la competencia podrán ser utilizadas por la organización y por las empresas auspiciantes para fines de difusión y publicidad del evento y/o de productos asociados al mismo.
                Los competidores que acepten participar en este evento no tendrán derecho a realizar reclamos.<br><br>
                Responsabilidades: Al inscribirse, el participante acepta el presente reglamento y declara:<br>
                a).-Saber incluso que habrá lugares a los que no pueda accederse con vehículos, con lo cual la atención inmediata es limitada.<br>
                b).-Conocer las características del terreno y los riesgos posibles de lesiones traumatológicas como torceduras, esguinces, incluso fracturas. Y que por razones de seguridad, la organización priorizará la atención y evacuación de las emergencias y urgencias médicas, considerándose como tales a aquellos casos que puedan evolucionar en riesgo de muerte, pudiendo entonces demandar más tiempo la atención de lesiones como las antes descriptas.<br>
                c).-Eximir a los Organizadores, Municipios, los Propietarios de las tierras por las que pase la carrera y los Patrocinantes de toda responsabilidad por accidentes personales; daños y/o pérdidas de objetos que pudiera ocurrirle antes, durante o después de su participación en la prueba.

            </p>

            <p class="subtitulo mt-25">G) INSCRIPCION</p>
            <p>Se considera como medio oficial de comunicación e inscripciones la página https://dxb.fi.uncoma.edu.ar/ y completar los pasos requeridos.
                El participante deberá consultar periódicamente el sitio a fin de estar al tanto de novedades y posibles modificaciones en el.
            </p>



  <?php /*
    <div class="datosCaptcha" >
              <?= $form->field($persona, 'reCaptcha')->widget(
                  \himiklab\yii2\recaptcha\ReCaptcha2::className(),
                  [
                      'siteKey' => '6LcaGKgUAAAAAHFPZSlm2jc_GeKUoccTzRkhUkjK', // unnecessary is reCaptcha component was set up
                  ]
              ) ?>
    </div>
   */ ?>
<div id="reglamentoAceptado">
  <?= $form->field($carrerapersona, 'reglamentoAceptado')->checkbox(['label' => 'He leido y acepto los términos y condiciones*', 'uncheck' => 0]); ?>
</div>
</div>
<div class="db-label m-0">
            <label id="labelSexoDatoPersonal" class="m-0">Los campos con * son obligatorios</label>
          </div>

<?php 
/*Agregar la linea 'style'=>'border-radius: 15px;' en vendor/lesha724/ViewerJsDocument/viewer.php 
 en la funcion _run()
La funcion deberia quedar:
protected function _run(){
        $options = [
            'src'=>$this->_getIframeUrl(),
            'width'=>$this->width,
            'height'=>$this->height,
            'allowfullscreen',
            'webkitallowfullscreen',
            'style'=>'border-radius: 15px;'
        ];

        return Html::tag('iframe','',$options);
    }
 */


//Copiar y reemplazar el contenido de abajo en /web/assets/(buscar en que carpeta esta instaldo pdf.js)/index.html
/*
<body>
    <div id="viewer">
        <div id="titlebar" style="visibility: hidden;height: 0px;">
            <div id="documentName" style="visibility: hidden;height: 0px;"></div>
            <div id="titlebarRight" style="visibility: hidden;height: 0px;">
                <button id="presentation" class="toolbarButton presentation" title="Presentation"></button>
                <button id="fullscreen" class="toolbarButton fullscreen" title="Fullscreen"></button>
                <button id="download" class="toolbarButton download" title="Download"></button>
            </div>
        </div>
        <div id="toolbarContainer" style="visibility: hidden;height: 0px;">
            <div id="toolbar" style="visibility: hidden;height: 0px;">
                <div id="toolbarLeft" style="visibility: hidden;height: 0px;">
                    <div id="navButtons" class="splitToolbarButton" style="visibility: hidden;height: 0px;">
                        <button id="previous" class="toolbarButton pageUp" title="Previous Page"></button>
                        <div class="splitToolbarButtonSeparator"></div>
                        <button id="next" class="toolbarButton pageDown" title="Next Page"></button>
                    </div>
                    <label id="pageNumberLabel" class="toolbarLabel" for="pageNumber">Page:</label>
                    <input type="number" id="pageNumber" class="toolbarField pageNumber" />
                    <span id="numPages" class="toolbarLabel"></span>
                </div>
                <div id="toolbarMiddleContainer" class="outerCenter">
                    <div id="toolbarMiddle" class="innerCenter">
                        <div id='zoomButtons' class="splitToolbarButton">
                            <button id="zoomOut" class="toolbarButton zoomOut" title="Zoom Out"></button>
                            <div class="splitToolbarButtonSeparator"></div>
                            <button id="zoomIn" class="toolbarButton zoomIn" title="Zoom In"></button>
                        </div>
                        <span id="scaleSelectContainer" class="dropdownToolbarButton">
                                <select id="scaleSelect" title="Zoom" oncontextmenu="return false;">
                                    <option id="pageAutoOption" value="auto" selected>Automatic</option>
                                    <option id="pageActualOption" value="page-actual">Actual Size</option>
                                    <option id="pageWidthOption" value="page-width">Full Width</option>
                                    <option id="customScaleOption" value="custom"> </option>
                                    <option value="0.5">50%</option>
                                    <option value="0.75">75%</option>
                                    <option value="1">100%</option>
                                    <option value="1.25">125%</option>
                                    <option value="1.5">150%</option>
                                    <option value="2">200%</option>
                                </select>
                            </span>
                        <div id="sliderContainer">
                            <div id="slider"></div>
                        </div>
                    </div>
                </div>
                <div id="toolbarRight">
                </div>
            </div>
        </div>
        <div id="canvasContainer" style="background-image:none; background-color:white;top: 0px;bottom: 0;">
            <div id="canvas"></div>
        </div>
        <div id="overlayNavigator">
            <div id="previousPage"></div>
            <div id="nextPage"></div>
        </div>
        <div id="overlayCloseButton">
            &#10006;
        </div>
        <div id="dialogOverlay"></div>
        <div id="blanked"></div>
    </div>
</body>

*/
?>