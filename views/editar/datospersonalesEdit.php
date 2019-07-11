<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form" id="primerStep">

    <!-- vista del tab datos personales del formulario-->
    <div class="datosPersonales" >

        <div class="container width-100">
            <!-- Checkbox donde selecciona si es capitan del equipo o no-->
            <div class="row" style="margin-left: 20px;">
                <?php
                if($capitan==true){
                    ?>
                    <div class="left" >
                        <label style="font-weight: bold">Sos capitán: </label>
                        <br>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="left" >
                        <label>Perteneces al equipo de:</label>
                    </div>
                    <br>

                    <?php
                }
                ?>

                <!--
                 <div class="switch pull-left" >
                    <input type="radio" class="switch-input input-db" name="swichtCapitan" value="1" id="week" onClick=controlSwichtCapitan() >
                    <label for="week" class="switch-label switch-label-off">SI</label>
                    <input type="radio" class="switch-input input-db" name="swichtCapitan" value="0" id="month" checked onClick=controlSwichtCapitan()>
                    <label for="month" class="switch-label switch-label-on">NO</label>
                    <span class="switch-selection"></span>
                </div>
                 -->

            </div>

            <!-- Estas son las opciones que ve si selecciona que es capitan -->
            <?php
            if($capitan==true){
                ?>
                <div class="row db-label">
                    <div id="opcionesCapitan" style="<?php ($capitan==false)?"display:none":"";?>" aria-label="..." class="col-1">

                        <div id="tipoCarrera" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div>Carrera</div>
                            <!--$form->field($tipoCarrera,'idTipoCarrera')->dropDownList($tipocarreraLista,['readonly'=>true])->label('');-->
                            <?= Html::input('text','tipoCarrera',$tipoCarrera->descripcionCarrera, $option=['class'=>'form-control','disabled'=>true]) ?>


                        </div>

                        <div id="cantidadPeronas" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div>Cantidad de corredores</div>
                            <!-- $form->field($equipo,'cantidadPersonas')->dropDownList($cantCorredores,['readonly'=>true])->label('');  -->
                            <?= Html::input('text','cantidadPersonas',$cantCorredores, $option=['class'=>'form-control','disabled'=>true]) ?>

                        </div>


                    </div>
                </div>

                <?php
            }else{
                ?>
                <!-- Opciones que visualiza si selecciona que no es capitan -->
                <div class="row db-label">
                    <div id="opcionesNoSoyCapitan" style="<?php ($capitan==true)?"display:none":"";?>" aria-label="..." class="col-1">

                        <div id="dniCapitan" class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                            <div>DNI capitán</div>

                            <?= Html::input('text','dniCapitan',$equipo->dniCapitan, $option=['class'=>'form-control','disabled'=>true]) ?>
                        </div>

                        <div id="nombreCapitan" class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                            <div>Nombre capitán</div>
                            <?= Html::input('text','nombreCapitan',$nombreCapitan, $option=['class'=>'form-control','disabled'=>true]) ?>
                        </div>


                        <div id="tipoDeCarrera" class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                            <div>Tipo de carrera</div>
                            <?= Html::input('text','tipoCarrera',$tipoCarrera->descripcionCarrera, $option=['class'=>'form-control','disabled'=>true]) ?>
                        </div>

                        <div id="cantidadPersonas" class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                            <div>Cantidad de corredores</div>
                            <?= Html::input('text','cantidadPersonas',$cantCorredores, $option=['class'=>'form-control','disabled'=>true]) ?>
                        </div>


                    </div>

                </div>

                <?php
            }
            ?>




            <div class="row db-label">

                <!--
                -->
                <div id="dniUsuario" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                    <?= $form->field($usuario, 'dniUsuario')->textInput(['class' => 'input-db soloLectura','placeholder'=>'DNI','readonly'=>true])->label('DNI *')?>
                </div>

                <div id="nacionalidadPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                    <?= $form->field($persona, 'nacionalidadPersona')->textInput(['maxlength' => true, 'class' => 'input-db', 'placeholder'=>'Nacionalidad']) ?>
                </div>

                <div id="nombrePersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                    <?= $form->field($persona, 'nombrePersona')->textInput(['maxlength' => true, 'class' => 'input-db','placeholder'=>'Nombre']) ?>
                </div>

                <div id="apellidoPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                    <?= $form->field($persona, 'apellidoPersona')->textInput(['maxlength' => true, 'class' => 'input-db','placeholder'=>'Apellido'])?>
                </div>
            </div>
            <div class="row">

                <div id="fechaNacPersona" class="col-md-4 col-lg-4 col-sm-4 col-xs-12 db-label">

                    <!-- utilizacion de un widget de kartik llamado DatePicker, permite escoger
                    una fecha desde un calendario permitiendo tambien seleccionar años o meses
                    con una mayor facilidad -->
                    <?=  $form->field($persona, 'fechaNacPersona')->textInput(['class'=>'datepicker form-control input-db','id'=>'datepicker', 'placeholder'=>'Fecha de nacimiento']) ?>

                </div>

                <div id="sexoPersona" class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="db-label m-0">
                        <label id="labelSexoDatoPersonal" class="m-0">Sexo *</label>
                    </div>
                    <!-- campo tipo radioButton, con dos opciones: SI o NO -->
                    <?= $form->field($persona, 'sexoPersona')->radioList(array('F'=>'Femenino','M'=>'Masculino'))->label('')?>
                </div>

                <div id="talleRemera" class="col-md-4 col-lg-4 col-sm-4 col-xs-12 db-label">

                    <?=$form->field($talleRemera, 'idTalleRemera')->dropDownList($listadoTalles, ['prompt' => 'Talle de remera' ])->label('Talle de remera *'); ?>
                </div>
            </div>


        </div>

    </div>

</div>
