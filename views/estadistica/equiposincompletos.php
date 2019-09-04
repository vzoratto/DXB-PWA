<br>
<br>
<div class="equipo-index reglamento-container">

    <?php
        echo '<h3>Equipos Incompletos de Dos que aun no pagaron: '. count($equiposIncompletosSinPagar).'</h3>';
        foreach($equiposIncompletosSinPagar as $equipo){
            $usuario=\app\models\Usuario::findOne(['dniUsuario'=>$equipo->dniCapitan]);
            echo $equipo->idEquipo. '-' . strtolower($usuario->mailUsuario);
            echo '<br>';
        }

    echo '<h3>Equipos Incompletos de Cuatro que aun no pagaron: '. count($equiposDosIncompletosSinPagarCuatro).'</h3>';
    foreach($equiposDosIncompletosSinPagarCuatro as $equipoCuatro){
        $usuarioCuatro=\app\models\Usuario::findOne(['dniUsuario'=>$equipoCuatro->dniCapitan]);
        echo $equipoCuatro->idEquipo. '-' . strtolower($usuarioCuatro->mailUsuario);
        echo '<br>';

    }
    ?>

</div>