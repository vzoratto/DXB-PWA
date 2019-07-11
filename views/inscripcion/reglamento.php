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
    <div style="width: 100%;height: 100%;margin-left: 10%;">
    <?php 
            echo \lesha724\documentviewer\ViewerJsDocumentViewer::widget([
            'url' => '../../../web/archivo/Reglamento.pdf', //url на ваш документ или http://example.com/test.odt
            'width'=>'80%',
            'height'=>'300px',
            ]);
        ?>
    </div>
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
            <label id="labelSexoDatoPersonal"class="m-0">Los campos con * son obligatorios</label>
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