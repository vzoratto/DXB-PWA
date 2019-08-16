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
        <div class="subtitulo text-center">
            Hola <?php echo strtoupper($persona->getNombreCompleto());?>

        </div>
        <?php

                //si carrepersona es null significa que fue dado de baja
                if($carreraPersona==null){
                    ?>
                    <p>
                        Al dia de la fecha, el estado de tu inscripcion es en: <strong style="color:#e34400">DADO DE BAJA</strong>
                        estas <strong style="color:#e34400">INHABILITAD/A</strong> para participar de la carrera si deseas participar comunicate con la organización


                    </p>

                <?php


                //si esta habilitado primero verifica que no este en lista de espera
                }else{
                    if($listaEspera){
                        ?>
                        <p>
                            Al dia de la fecha, el estado de tu inscripcion es en: <strong style="color:#e34400">LISTA DE ESPERA</strong>


                        </p>

                        <?php
                    }
                    //si el capitan del equipo es invitado
                    //signfiica que todo el equipo es invitado
                    //muestra que el equipo es invitado
                    if($equipo->invitado()==true){
                        ?>
                        <p>
                            Al dia de la fecha, el estado de pago de tu inscripción es <strong style="color:#2d6e18">INVITADO</strong>
                            estas <strong style="color:#2d6e18">HABILITADO/A</strong> para participar de la carrera

                        </p>

                   <?php
                    }

                //si no esta en lista de espera, ya se puede verificar si pago o no
                //si no se encuentar el pago significa que no pago o no fue chequeado
                elseif($estadoPago==null){
                    ?>

                        <p>
                            Al dia de la fecha, el estado de tu inscripción es <strong style="color:#e34400">IMPAGO</strong> o todavía no fue chequeado
                            te recordamos que el capitán del equipo es el encargado de subir el comprobante del  pago.

                        </p>
                     <strong>Costo de inscripción:</strong>
                        <p>El costo de la inscripción por participante es de $200 (doscientos).</p>

                        <p>Para grupos de 2 personas, el importe sera de $400, y para grupos de 4 personas, el importe será de $800.</p>



                        <?php
                        if($capitan==true){
                            ?>
                            <p>
                                Las inscripciones se podrán abonar por transferencia bancaria o en forma presencial en los siguientes lugares:

                            </p>
                            <p>
                                *ByB Indumentaria Deportiva, Instalaciones Gimnasio Terra.
                                Diagonal Alvear 45, Neuquén Capital de 17 a 21 hrs.
                            </p>
                            <p>*Polideportivo Beto Monteros – Unco. En horario de 8 a 13hs.</p>
                            <p>
                                Banco Credicop Cooperativo Limitado
                                Adherente: Universidad Nacional del Comahue.
                                Operador: 549505 Roberto Antonio Sepulveda
                                Numero de cuenta - Cuenta corriente: 191-093-024908/9.
                                CBU: 19100933-55009302490896</p>
                            <p>Para subir comprobante de pago haz click en el siguiente <a href="index.php?r=pago/create">ENLACE</a> </p>
                            <?php
                        }
                        ?>





                    <?php
                    //si el pago es completo(se abono y chequeo la totalidad del costo de inscripciion)
                    //o si el pago es cancelo(significa que el usuario hizo pagos parciales hasta saldar la deuda)
                }elseif ($estadoPago->idEstadoPago==1 || $estadoPago->idEstadoPago==3){
                    ?>
                    <p>
                        Al dia de la fecha, el estado de pago de tu inscripción es <strong style="color:#2d6e18">PAGO COMPLETO</strong>
                        estas <strong style="color:#2d6e18">HABILITADO/A</strong> para participar de la carrera

                    </p>
                    <?php
                    //si el usuario hizo un pago parcial y todavia no termina de saldar la deuda
                }elseif ($estadoPago->idEstadoPago==2){
                    ?>
                    <p>
                        Al dia de la fecha, el estado de pago de tu inscripción es <strong style="color:#ff8000">PAGO PARCIAL</strong>


                    </p>
                    <?php
                    if($capitan==true){
                        ?>
                        <p>Para completar el pago  haz click en el siguiente <a href="index.php?r=pago/create">ENLACE</a> </p>
                        <?php
                    }

                    ?>



                    <?php
                }





                      //termina el else de carrerapersona
                }



        ?>



        <?php
        //empieza otro php
        if($capitan==true){
            ?>
            <p>Sos <strong><?php echo ($personaCapitan->sexoPersona=='F') ? 'CAPITANA':'CAPITÁN';?></strong> del equipo <?php  echo $equipo['idEquipo'];?>
            </p>
        <?php
        }else{
            ?>
            <strong><?php echo ($personaCapitan->sexoPersona=='F') ? 'La capitana':'El capitán';?> del equipo es <?php echo strtoupper( $nombreCapitan);?> </strong>
            <br>
            <br>

        <?php
        }

        ?>
        <p>El EQUIPO <?php echo $equipo['idEquipo'];?> esta formado de la siguiente manera:</p>
        <table class="table table-responsive table-bordered">


            <thead>
            <tr>

                <th colspan="22" style="text-align: center;"> Equipo: <?php echo $equipo['idEquipo'];?>- Carrera <?php echo  $tipoCarrera['descripcionCarrera'] ;?> - Cantidad Corredores: <?php echo $cantCorredores;?></th>

            </tr>
            <tr>

                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>

            </tr>
            </thead>
            <tbody>

            <?php
            //se accede a todas las personas del equipo
            foreach ($equipo->persona as $persona){
                ?>
                <tr>
                    <td><?php echo $persona['nombrePersona'];?></td>
                    <td><?php echo $persona['apellidoPersona'];?></td>
                    <td><?php echo $persona->usuario->dniUsuario;?></td>


                </tr>

                <?php

            }
            ?>

            </tbody>

        </table>






</div>