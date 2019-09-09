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
                <?php $form = ActiveForm::begin([
                    'method'=>'get',
                    "action"=>"index.php?r=result%2Fresultados",
                    "enableClientValidation"=>true,
                ]); ?>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="sel1">Categoria:</label>
                            <select name="tipoCarrera" class="form-control" id="sel1">
                                <option value="1" <?php echo ($tipoCarrera==1)?'selected':''?>>Recreativa - 4 KM</option>
                                <option value="2" <?php echo ($tipoCarrera==2)?'selected':''?> >Competitiva - 8 KM</option>

                            </select>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="sel1">Cantidad Personas:</label>
                            <select name="cantPersonas" class="form-control" id="sel1">
                                <option value="2" <?php echo ($cantPersonas==2)?'selected':''?> >2</option>
                                <option value="4" <?php echo ($cantPersonas==4)?'selected':''?>>4</option>
                            </select>
                        </div>


                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Clic para filtrar</label>
                            <br>
                            <button class="btn btn-primary btn-sm" type="submit">Filtrar</button>
                        </div>



                    </div>
                <?php ActiveForm::end(); ?>


            </div>

            <div class="row">
                <div class="col-6">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Pos.</th>
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






                        </tr>

                        </thead>
                        <?php
                        $contador=1;
                         foreach ($resultados as $result){
                                $equipo=\app\models\Equipo::findOne(['nombreEquipo'=>$result->numEquipo]);
                                $usu=\app\models\Usuario::findOne(['dniUsuario'=>$equipo->dniCapitan]);
                                $persona=\app\models\Persona::findOne(['idUsuario'=>$usu->idUsuario]);
                                $nombreAp=strtoupper($persona->apellidoPersona.' '.$persona->nombrePersona);
                                $totalPenalidad=$result->penalizacionBolsa+$result->trivia;
                             ?>
                             <tr <?php echo ($contador==1 or $contador==2 or $contador==3) ? 'bgcolor="#08ff52"' :'' ?>>
                                 <td style="font-weight: bold"><?php echo $contador;?></td>
                                 <td style="font-weight: bold"><?php echo $result->numEquipo;?></td>
                                 <td style="font-size: 15px; font-weight: bold"><?php echo $nombreAp;?></td>
                                 <td style="font-weight: bold"><?php echo date("H:i:s",$result->total/1000);?></td>
                                 <td style="font-weight: bold"><?php echo date("H:i:s", $result->tiempoLlegada/1000);?></td>
                                 <td style="font-weight: bold"><?php echo date("H:i:s",$totalPenalidad/1000);?></td>
                                 <td style="font-weight: bold"><?php echo $result->bolsasCompletas;?></td>
                                 <td style="font-weight: bold"><?php echo $result->respuestasCorrectas;?></td>
                                 <td style="font-weight: bold"><?php echo date("H:i:s",$result->penalizacionBolsa/1000);?></td>
                                 <td style="font-weight: bold"><?php echo date("H:i:s",$result->trivia/1000);?></td>
                                 <td style="font-weight: bold; font-size: 12px"><?php echo strtoupper($equipo->tipoCarrera->descripcionCarrera);?></td>
                                 <td style="font-weight: bold"><?php echo $equipo->cantidadPersonas;?></td>






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



