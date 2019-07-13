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
  <div class="align-center">
  <?php
        echo \lesha724\documentviewer\ViewerJsDocumentViewer::widget([
          'url' => '../../../Reglamento/Presentaciondelamateria.pdf', //url на ваш документ или http://example.com/test.odt
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
  <?= $form->field($carrerapersona, 'reglamentoAceptado')->checkbox(['label' => 'He leido y acepto los términos y condiciones', 'uncheck' => 0]); ?>
</div>
</div>
<div class="db-label m-0">
            <label id="labelSexoDatoPersonal"class="m-0">Los campos con * son obligatorios</label>
          </div>

<?php 
//Copiar y reemplazar el contenido de abajo en /web/assets/bb1d2b31/index.html
/*
<body>
    <div id="viewer">
        <div id="titlebar" style="visibility: hidden;height: 0px;">
            <div id="documentName" style="visibility: hidden;"></div>
            <div id="titlebarRight" style="visibility: hidden;">
                <button id="presentation" class="toolbarButton presentation" title="Presentation"></button>
                <button id="fullscreen" class="toolbarButton fullscreen" title="Fullscreen"></button>
                <button id="download" class="toolbarButton download" title="Download"></button>
            </div>
        </div>
        <div id="toolbarContainer" style="visibility: hidden;height: 0px;">
            <div id="toolbar">
                <div id="toolbarLeft">
                    <div id="navButtons" class="splitToolbarButton">
                        <div class="splitToolbarButtonSeparator"></div>
                    </div>
                    <input type="number" id="pageNumber" class="toolbarField pageNumber" style="visibility: hidden;" />
                    <span id="numPages" class="toolbarLabel" style="visibility: hidden;"></span>
                </div>
                <div id="toolbarMiddleContainer" class="outerCenter" style="visibility: hidden;">
                    <div id="toolbarMiddle" class="innerCenter" style="visibility: hidden;">
                        <div id='zoomButtons' class="splitToolbarButton" style="visibility: hidden;">
                            <button id="zoomOut" class="toolbarButton zoomOut" title="Zoom Out" style="visibility: hidden;"></button>
                            <div class="splitToolbarButtonSeparator" style="visibility: hidden;"></div>
                            <button id="zoomIn" class="toolbarButton zoomIn" title="Zoom In" style="visibility: hidden;"></button>
                        </div>
                        <span id="scaleSelectContainer" class="dropdownToolbarButton" style="visibility: hidden;">
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
        <div id="canvasContainer" style="background-image:none; background-color:white">
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