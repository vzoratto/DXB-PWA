<?php
/**
 * Created by PhpStorm.
 * User: ariel
 * Date: 29/08/19
 * Time: 23:51
 */


?>
<div class="equipo-index reglamento-container">
    <?php

    echo '<br>';
    echo '<br>';
    echo '<br>';

    echo 'equipos habilitados '.count($equipos);
    echo '<br>';
    echo 'equipos incompletos '. $equiposIncompletos;
    echo '<br>';
    echo 'cantidad de personas que faltan inscribirse segun equipo:'.$personasFaltanInscribirse;
    echo '<br>';
    $usuarios=[];
    foreach ($dniCapitanes as $dnicapitan){
        $usuario=\app\models\Usuario::findOne(['dniUsuario'=>$dnicapitan]);
        $usuarios[]=$usuario;


    }
    echo '<h3>Mail capitanes equipos incompletos total: '. count($usuarios).'</h3>';
    foreach($usuarios as $usuario){
        echo  strtolower($usuario->mailUsuario);
        echo '<br>';
    }
    echo '<hr>';
    echo '<h3>Total Equipos ocupando cupo(al menos cap) sin pagar:'. count($equiposOcupandoCuposSinPagar).'</h3>';
    $cuposOcupadosEquipoSinPagar=0;
    foreach ($equiposOcupandoCuposSinPagar as $equipoSinPagar){
        $usuarioCap=\app\models\Usuario::findOne(['dniUsuario'=>$equipoSinPagar->dniCapitan]);
        $cuposOcupadosEquipoSinPagar=$cuposOcupadosEquipoSinPagar+$equipoSinPagar->cuposOcupados();
        echo $usuarioCap->mailUsuario;
        echo '<br>';

    }
    echo '<h3>Total Cupos a liberar'.$cuposOcupadosEquipoSinPagar.'</h4>';
    echo '<hr>';
    ?>

</div>
