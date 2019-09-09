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


    <div class="container">
        <div class="row">


            <div class="col-sm-3">
                <div class="form-group">
                    <label for="sel1">Num Equipo competencia:</label>
                    <input name="nombreEquipo">
                </div>


            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Clic para filtrar</label>
                    <br>
                    <button class="btn btn-primary btn-sm" type="submit">Filtrar</button>
                </div>



            </div>



        </div>

        <div class="row">
            <div class="col-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>id resultado</th>
                        <th>Equipo</th>
                        <th>Capitán</th>
                        <th>Tiempo Final</th>
                        <th>Tiempo llegada</th>
                        <th>Total Penalidades</th>
                        <th>Bolsas Completas</th>
                        <th>Respuestas Correctas</th>
                        <th>Penalidad Bolsas</th>
                        <th>Penalidad Trivia</th>
                        <th>Competencia</th>
                        <th>Personas Equipo</th>
                        <th>Acciones</th>






                    </tr>

                    </thead>
                    <?php
                    $contador=1;
                    foreach ($resultados as $result){
                        $equipo=\app\models\Equipo::findOne(['nombreEquipo'=>$result->numEquipo]);
                        $usu=\app\models\Usuario::findOne(['dniUsuario'=>$equipo->dniCapitan]);
                        $persona=\app\models\Persona::findOne(['idUsuario'=>$usu->idUsuario]);
                        $nombreAp=strtolower($persona->apellidoPersona.' '.$persona->nombrePersona);
                        $totalPenalidad=$result->penalizacionBolsa+$result->trivia;
                        ?>
                        <tr>
                            <td><?php echo $result->idResultado?></td>
                            <td><?php echo $result->numEquipo;?></td>
                            <td><?php echo $nombreAp;?></td>
                            <td><?php echo date("H:i:s",$result->total/1000);?></td>
                            <td><?php echo date("H:i:s", $result->tiempoLlegada/1000);?></td>
                            <td><?php echo date("H:i:s",$totalPenalidad/1000);?></td>
                            <td><?php echo $result->bolsasCompletas;?></td>
                            <td><?php echo $result->respuestasCorrectas;?></td>
                            <td><?php echo date("H:i:s",$result->penalizacionBolsa/1000);?></td>
                            <td><?php echo date("H:i:s",$result->trivia/1000);?></td>
                            <td><?php echo '<p>'. $equipo->tipoCarrera->descripcionCarrera.'</p>';?></td>
                            <td><?php echo $equipo->cantidadPersonas;?></td>
                            <td>
                                <a href="index.php?r=result/busc&numEquipo=<?php echo $result->numEquipo;?>" class="btn btn-primary">Editar</a>
                                <a href="index.php?r=result/busc&numEquipo=<?php echo $result->numEquipo;?>" class="btn btn-danger">Eliminar</a>

                            </td>






                        </tr>
                        <?php
                        $contador++;
                    }

                    ?>
                </table>
            </div>
        </div>

    </div>
</div>
