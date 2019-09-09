<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Result */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="result-form">

    <?php $form = ActiveForm::begin(
        [
            'method'=>'get',
            "action"=>"index.php?r=result%2Fprocesarmodi",
        ]
    ); ?>
    <div class="container">
        <?php
            $equipo=\app\models\Equipo::findOne(['nombreEquipo'=>$resultado->numEquipo]);
            $usuarioCap=\app\models\Usuario::findOne(['dniUsuario'=>$equipo->dniCapitan]);
            $personaCap=\app\models\Persona::findOne(['idUsuario'=>$usuarioCap->idUsuario]);
        ?>
        <input type="hidden" name="numEquipo" value="<?php echo $resultado->numEquipo;?>">
        <h3>Nombre y Apellido Capitan: <?php echo strtolower($personaCap->apellidoPersona.' '.$personaCap->nombrePersona); ?></h3>
        <h3>Competencia: <?php echo $equipo->tipoCarrera->descripcionCarrera; ?></h3>
        <h3>Cantidad Personas: <?php echo $equipo->cantidadPersonas; ?></h3>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <h3>Numero Equipo <?php echo $resultado->numEquipo;?></h3>


                </div>
                <div class="form-group">
                    <p>formato Hora: <?php echo date("H:i:s", $resultado->tiempoLlegada/1000);?></p>
                    <p>Tiempo Llegada</p>
                    <input type="text" class="form-control" name="tiempoLlegada" value="<?php echo $resultado->tiempoLlegada ?>">

                </div>
                <div class="form-group">
                    <label>Respuestas Correctas</label>
                    <input type="text" class="form-control" name="respuestasCorrectas" value="<?php echo $resultado->respuestasCorrectas ?>">

                </div>
                <div class="form-group">
                    <label>bolsasCompletas</label>
                    <input type="text" class="form-control" name="bolsasCompletas" value="<?php echo $resultado['bolsasCompletas']; ?>">

                </div>
                <button class="btn btn-primary" type="submit">Modificar</button>
            </div>


        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>