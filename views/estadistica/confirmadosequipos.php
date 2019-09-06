<br>
<br>
<div class="equipo-index reglamento-container">
    <?php echo '<h3>Equipos Recreativa 2 personas: '. count($equiposDosRecreativa).'</h3>';?>
    <?php
     $contadorRecreDos=1;
    ?>
    <table class="table table-sm">
        <tr>
            <th></th>
            <th>Id Equipo Sistema</th>
            <th>DNI Capitan</th>
            <th>Nombre Capitan</th>
            <th>Equipo Completo</th>
        </tr>
        <tbody>
        <?php

        //$contador=1;

        foreach($equiposDosRecreativa as $equipoDosRecre){
            $usuario=\app\models\Usuario::findOne(['dniUsuario'=>$equipoDosRecre->dniCapitan]);
            $persona=\app\models\Persona::findOne(['idUsuario'=>$usuario->idUsuario]);
            ?>
            <tr>
                <td><?php echo $contadorRecreDos ?></td>
                <td><?php echo $equipoDosRecre->idEquipo ?></td>
                <td><?php echo strtolower($usuario->dniUsuario) ?></td>
                <td><?php echo strtolower($persona->apellidoPersona. ' '.$persona->nombrePersona) ?></td>
                <td><?php echo $equipoDosRecre->equipoCompleto();?></td>

            </tr>

    <?php
        $contadorRecreDos++;
        }

        ?>

        </tbody>
    </table>
    <hr>
    <?php echo '<h3>Equipos Recreativa 4 personas: '. count($equiposCuatroRecreativa).'</h3>';?>
    <?php
    $contadorRecreCuatro=1;
    ?>
    <table class="table table-sm">
        <tr>
            <th></th>
            <th>Id Equipo Sistema</th>
            <th>DNI Capitan</th>
            <th>Nombre Capitan</th>
            <th>Equipo Completo</th>
        </tr>
        <tbody>
        <?php

        //$contador=1;

        foreach($equiposCuatroRecreativa as $equipoCuatroRecre){
            $usuario=\app\models\Usuario::findOne(['dniUsuario'=>$equipoCuatroRecre->dniCapitan]);
            $persona=\app\models\Persona::findOne(['idUsuario'=>$usuario->idUsuario]);
            ?>
            <tr>
                <td><?php echo $contadorRecreCuatro ?></td>
                <td><?php echo $equipoCuatroRecre->idEquipo ?></td>
                <td><?php echo strtolower($usuario->dniUsuario) ?></td>
                <td><?php echo strtolower($persona->apellidoPersona. ' '.$persona->nombrePersona) ?></td>
                <td><?php echo $equipoCuatroRecre->equipoCompleto();?></td>

            </tr>
            <?php
            $contadorRecreCuatro++;
        }

        ?>

        </tbody>
    </table>
    <hr>

    <?php echo '<h3>Equipos Competitiva 2 personas: '. count($equiposDosCompetitiva).'</h3>';?>
    <?php
    $contadorCompeDos=1;
    ?>
    <table class="table table-sm">
        <tr>
            <th></th>
            <th>Id Equipo Sistema</th>
            <th>DNI Capitan</th>
            <th>Nombre Capitan</th>
            <th>Equipo Completo</th>
        </tr>
        <tbody>
        <?php

        //$contador=1;

        foreach($equiposDosCompetitiva as $equipoDosCompe){
            $usuario=\app\models\Usuario::findOne(['dniUsuario'=>$equipoDosCompe->dniCapitan]);
            $persona=\app\models\Persona::findOne(['idUsuario'=>$usuario->idUsuario]);
            ?>
            <tr>
                <td><?php echo $contadorCompeDos ?></td>
                <td><?php echo $equipoDosCompe->idEquipo ?></td>
                <td><?php echo strtolower($usuario->dniUsuario) ?></td>
                <td><?php echo strtolower($persona->apellidoPersona. ' '.$persona->nombrePersona) ?></td>
                <td><?php echo $equipoDosCompe->equipoCompleto();?></td>

            </tr>
            <?php
            $contadorCompeDos++;
        }

        ?>

        </tbody>
    </table>
    <hr>
    <?php echo '<h3>Equipos Competitiva 4 personas: '. count($equiposCuatroCompetitiva).'</h3>';?>
    <?php
    $contadorCompeCuatro=1;
    ?>
    <table class="table table-sm">
        <tr>
            <th></th>
            <th>Id Equipo Sistema</th>
            <th>DNI Capitan</th>
            <th>Nombre Capitan</th>
            <th>Equipo Completo</th>
        </tr>
        <tbody>
        <?php

        //$contador=1;

        foreach($equiposCuatroCompetitiva as $equipoCuatroCompe){
            $usuario=\app\models\Usuario::findOne(['dniUsuario'=>$equipoCuatroCompe->dniCapitan]);
            $persona=\app\models\Persona::findOne(['idUsuario'=>$usuario->idUsuario]);
            ?>
            <tr>
                <td><?php echo $contadorCompeCuatro ?></td>
                <td><?php echo $equipoCuatroCompe->idEquipo ?></td>
                <td><?php echo strtolower($usuario->dniUsuario) ?></td>
                <td><?php echo strtolower($persona->apellidoPersona. ' '.$persona->nombrePersona) ?></td>
                <td><?php echo $equipoCuatroCompe->equipoCompleto();?></td>

            </tr>
            <?php
            $contadorCompeCuatro++;
        }

        ?>

        </tbody>
    </table>
    <hr>


</div>