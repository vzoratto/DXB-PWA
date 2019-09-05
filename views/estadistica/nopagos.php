<br>
<br>
<div class="equipo-index reglamento-container">

    <?php
    echo '<h3>Equipos no pagados: '. count($equiposNoAbonados).'</h3>';
    $contador=1;

    foreach($equiposNoAbonados as $equipo){
        //$usuario=\app\models\Usuario::findOne(['dniUsuario'=>$equipo->dniCapitan]);
        $personasEnElEquipo=$equipo->personasEnElEquipo();
        foreach ($personasEnElEquipo as $persona){
            echo $contador.'-'. $equipo->idEquipo. '-' . strtolower($persona->mailPersona);

            echo '<br>';
            $contador++;
        }
        //echo $equipo->idEquipo. '-' . strtolower($usuario->mailUsuario);

        //echo '<br>';
    }

    ?>

</div>