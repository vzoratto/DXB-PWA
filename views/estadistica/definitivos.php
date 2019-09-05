<br>
<br>
<div class="equipo-index reglamento-container">

    <?php
    echo '<h3>Equipos: '. count($equiposPagados).'</h3>';
    echo '<h3>Cupos: '. $cuposTotal.'</h3>';
    $contador=1;
    foreach($equiposPagados as $equipo){
        $usuario=\app\models\Usuario::findOne(['dniUsuario'=>$equipo->dniCapitan]);
        echo $contador.'-'.$equipo->idEquipo. '-' . strtolower($usuario->mailUsuario);
        $contador++;
        echo '<br>';
    }

    ?>

</div>