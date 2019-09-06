<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Personaemergencia */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<br>
<br>
<br>

    <!-- vista del tab reglamento-->
    <div class="reglamento">
        <div class="titulo-primario text-center">
            <h1>
                <?= Html::encode($this->title) ?>
            </h1>
        </div>
        <div class="subtitulo text-center">
            <h2><i>Resultados</i></h2>
        </div>
        <label>Filtrar</label>
        <select>
            <option></option>
        </select>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Equipo</th>
                            <th>Tiempo llegada</th>
                            <th>Bolsas Completas</th>
                            <th>Penalidad Bolsas</th>
                            <th>Respuestas Correctas</th>
                            <th>Penalidad Trivia</th>
                            <th>Total</th>
                        </tr>

                        </thead>
                        <?php
                         foreach ($resultados as $result){
                             ?>
                             <tr>
                                 <td><?php echo $result->numEquipo;?></td>
                                 <td><?php echo date("H:i:s", $result->tiempoLlegada/1000);?></td>
                                 <td><?php echo $result->bolsasCompletas;?></td>
                                 <td><?php echo date("H:i:s",$result->penalizacionBolsa/1000);?></td>
                                 <td><?php echo $result->respuestasCorrectas;?></td>
                                 <td><?php echo date("H:i:s",$result->trivia/1000);?></td>
                                 <td><?php echo date("H:i:s",$result->total/1000);?></td>
                             </tr>
                        <?php
                         }

                        ?>
                    </table>
                </div>
            </div>

        </div>




    <div>