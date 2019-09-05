<br>
<br>
<div class="equipo-index reglamento-container">

    <?php
    echo '<h3>Cupos ocupados definitivos: '. $personasOcupandoCupoDefinitivo.'</h3>';
    echo '<h3>Equipos Abonados con corredores en espera: '. count($equiposAbonadosConParticipanteEspera).'</h3>';
    echo '<h3>Total de cupos que se necesitan: '. $cuposRequeridos.'</h3>';

    foreach($equiposAbonadosConParticipanteEspera as $equipo){
        $usuario=\app\models\Usuario::findOne(['dniUsuario'=>$equipo->dniCapitan]);
        echo $equipo->idEquipo. '-' . strtolower($usuario->mailUsuario);
        echo '<br>';
    }
    echo '<hr>';
    echo '<h3>Equipos  abonados incompletos: '. count($equiposAbonadosIncompletos).'</h3>';
    foreach($equiposAbonadosIncompletos as $equipoInc){
        $usuario=\app\models\Usuario::findOne(['dniUsuario'=>$equipoInc->dniCapitan]);
        echo $equipoInc->idEquipo. '-' . strtolower($usuario->mailUsuario);
        echo '<br>';
    }

    echo '<h3>Equipos  de cuatro abonados incompletos: '. count($equiposCuatroAbonadosIncompletos).'</h3>';
    $cuposOcupanCuatro=0;

    foreach($equiposCuatroAbonadosIncompletos as $equipoCuatroInc){
        $cuposOcupanCuatro=$cuposOcupanCuatro+$equipoCuatroInc->cantidadPersonas-$equipoCuatroInc->cuposOcupados();
        $usuarioCuatro=\app\models\Usuario::findOne(['dniUsuario'=>$equipoCuatroInc->dniCapitan]);
        echo $equipoCuatroInc->idEquipo. '-' . strtolower($usuarioCuatro->mailUsuario);
        echo '<br>';
    }
    echo '<h3>Cupos de cuatro que se requiere: '. $cuposOcupanCuatro.'</h3>';

    ?>

</div>