<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = $model->idEquipo;
\yii\web\YiiAsset::register($this);
?>
<div class="row">

<div class="col-lg-5">
    <h4>Información Equipo</h4>
    <?=
    DetailView::widget([
        'model' => $model,

    ])
    ?>
</div>
<div class="col-lg-5">

    <?php
     $idEquipo=$model->idEquipo;
     //se accede a todas las personas de equipo
     $grupoEquipo=\app\models\Grupo::findAll(['idEquipo'=>$idEquipo]);
     $totalEquipos=count($grupoEquipo);
    ?>

        <?php
        if($model->invitado()){
            echo '<h3 style="color: #00C900">INVITADO</h3>';
        }else{
            if($model->pagoInscripcion()){
                echo '<h3 style="color: #00C900" >ABONADO</h3>';
            }else{
                echo '<h3 style="color: red">NO ABONADO</h3>';
            }
        }


        ?>

    <strong>Integrantes del equipo</strong>
    <h4><?php echo $totalEquipos.' INTEGRANTES DE '. $model->cantidadPersonas?></h4>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Nombre y apellido</th>
                <th>DNI</th>
                <th>Email</th>
                <th>En espera</th>
            </tr>
        </thead>
        <tbody>

            <?php

                foreach ($grupoEquipo as $persona){
                    ?>
                    <tr <?php echo ($persona->persona->estoyEnEspera())?"bgcolor=#f58e33" :'' ?>>
                        <td><?php echo $persona->persona->NombreCompleto;?></td>
                        <td><?php echo $persona->persona->usuario->dniUsuario;?></td>
                        <td><?php echo $persona->persona->mailPersona;?></td>
                        <td><?php echo ($persona->persona->estoyEnEspera()) ?'EN ESPERA':'NO'?></td>
                    </tr>
                <?php

                }

            ?>

        </tbody>



    </table>
</div>

</div>