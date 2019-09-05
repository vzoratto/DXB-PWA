<br>
<br>
<div class="equipo-index reglamento-container">

    <?php
    echo '<h3>Equipos Abonados con corredores en espera: '. count($equiposAbonadosConParticipanteEspera).'</h3>';
    echo '<h3>Total de cupos que se necesitan: '. $cuposRequeridos.'</h3>';
    foreach($equiposAbonadosConParticipanteEspera as $equipo){
        $usuario=\app\models\Usuario::findOne(['dniUsuario'=>$equipo->dniCapitan]);
        echo $equipo->idEquipo. '-' . strtolower($usuario->mailUsuario);
        echo '<br>';
    }


    ?>

</div>