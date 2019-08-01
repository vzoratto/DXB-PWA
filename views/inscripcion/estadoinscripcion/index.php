<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Estado de mi inscripción';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="full-section p-0" style="background-image:url('assets/img/fondo.jpg');">

    <div class="col-md-8 col-md-offset-2 col-xs-12 text-justify reglamento-container mt-ten">

        <div class="titulo-primario text-center">
            <h2>
                <?= Html::encode($this->title) ?>
            </h2>
        </div>
        <?php
          if($capitan==true){
              //si es capitan se debera mostrar esto
              ?>
              <div class="subtitulo text-center">
                  Hola <?php echo $persona->getNombreCompleto();?>

              </div>
              <p>, sos capitán del equipo <?php  echo $equipo['idEquipo'];?>
                  ,tu equipo esta conformado de la siguiente manera:</p>

        <?php
          }else{
              ?>
              <div class="subtitulo text-center">
                  Hola <?php echo $persona->getNombreCompleto();?>
              </div>
              <p>
                  Al dia de la fecha, el estado de tu inscripcion es <strong style="color:#e34400">IMPAGO</strong>
                  te recordamos que el capitán del equipo es el encargado de subir el comprobante del  pago.
              </p>
              <p>Perteneces al EQUIPO <?php  echo $equipo['idEquipo'];?>
                  , esta conformado de la siguiente manera:
              </p>

              <table class="table table-responsive table-bordered" >


                  <thead>
                  <tr>

                      <th colspan="22" style="text-align: center;"> Equipo: <?php echo $equipo['idEquipo'];?>- Carrera <?php echo  $tipoCarrera['descripcionCarrera'] ;?> - Cantidad Corredores: <?php echo $cantCorredores;?></th>

                  </tr>
                  <tr>
                      <th>Rol</th>
                      <th>Nombre</th>
                      <th>Apellido</th>

                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>Corredor</td>
                        <td>Ariel</td>
                        <td>Villa</td>
                    </tr>
                  </tbody>

              </table>
              <p>Para pagar la inscripcion haz click en el siguiente enlace</p>

        <?php
          }
        ?>






</div>