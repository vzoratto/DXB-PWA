<br>
<br>
<div class="equipo-index reglamento-container">

    <?php
    echo '<h3>Email Cap Equipos con cap en espera: '. count($equiposCapEspera).'</h3>';
    foreach($equiposCapEspera as $equipo){
        $usuario=\app\models\Usuario::findOne(['dniUsuario'=>$equipo->dniCapitan]);
        echo $equipo->idEquipo. '-' . strtolower($usuario->mailUsuario);
        echo '<br>';
    }

    ?>

</div>