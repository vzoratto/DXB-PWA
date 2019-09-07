<br>
<br>
<div class="equipo-index reglamento-container">
    <?php echo '<h3>Recreativa 2 personas: '. count($personasDosRecreativo).'</h3>';?>
    <?php
    $contadorRecreDos=1;
    ?>
    <table class="table table-sm">
        <tr>
            <th></th>
            <th>ID equipo sistema</th>
            <th>DNI</th>
            <th>nombre y apellido</th>
            <th>DNI Capitan</th>
            <th>Nombre Capitan</th>
            <th>Acepto deslinde de responsabilidades</th>
            <th>Retiro kit</th>
        </tr>
        <tbody>
        <?php

        //$contador=1;

        foreach($personasDosRecreativo as $persona){

            ?>
            <tr>
                <td><?php echo $contadorRecreDos; ?></td>
                <td><?php echo $persona->equipo()->idEquipo; ?></td>
                <td><?php echo $persona->dni(); ?></td>
                <td><?php echo strtolower($persona->apellidoPersona.' '.$persona->nombrePersona); ?></td>
                <td><?php echo $persona->dniCapitan(); ?></td>
                <td><?php echo $persona->nombreCapitan();?></td>
                <td></td>
                <td></td>


            </tr>

            <?php
            $contadorRecreDos++;
        }

        ?>

        </tbody>
    </table>
    <hr>
    <?php echo '<h3>Recreativa 4 personas: '. count($personasCuatroRecreativo).'</h3>';?>
    <?php
    $contadorRecreDos=1;
    ?>
    <table class="table table-sm">
        <tr>
            <th></th>
            <th>ID equipo sistema</th>
            <th>DNI</th>
            <th>nombre y apellido</th>
            <th>DNI Capitan</th>
            <th>Nombre Capitan</th>
            <th>Acepto deslinde de responsabilidades</th>
            <th>Retiro kit</th>
        </tr>
        <tbody>
        <?php

        //$contador=1;

        foreach($personasCuatroRecreativo as $persona){

            ?>
            <tr>
                <td><?php echo $contadorRecreDos; ?></td>
                <td><?php echo $persona->equipo()->idEquipo; ?></td>
                <td><?php echo $persona->dni(); ?></td>
                <td><?php echo strtolower($persona->apellidoPersona.' '.$persona->nombrePersona); ?></td>
                <td><?php echo $persona->dniCapitan(); ?></td>
                <td><?php echo $persona->nombreCapitan();?></td>
                <td></td>
                <td></td>


            </tr>

            <?php
            $contadorRecreDos++;
        }

        ?>

        </tbody>
    </table>
    <hr>

    <?php echo '<h3>Competitiva 2 personas: '. count($personasDosCompetitiva).'</h3>';?>
    <?php
    $contadorRecreDos=1;
    ?>
    <table class="table table-sm">
        <tr>
            <th></th>
            <th>ID equipo sistema</th>
            <th>DNI</th>
            <th>nombre y apellido</th>
            <th>DNI Capitan</th>
            <th>Nombre Capitan</th>
            <th>Acepto deslinde de responsabilidades</th>
            <th>Retiro kit</th>
        </tr>
        <tbody>
        <?php

        //$contador=1;

        foreach($personasDosCompetitiva as $persona){

            ?>
            <tr>
                <td><?php echo $contadorRecreDos; ?></td>
                <td><?php echo $persona->equipo()->idEquipo; ?></td>
                <td><?php echo $persona->dni(); ?></td>
                <td><?php echo strtolower($persona->apellidoPersona.' '.$persona->nombrePersona); ?></td>
                <td><?php echo $persona->dniCapitan(); ?></td>
                <td><?php echo $persona->nombreCapitan();?></td>
                <td></td>
                <td></td>


            </tr>

            <?php
            $contadorRecreDos++;
        }

        ?>

        </tbody>
    </table>
    <hr>
    <br>
    <?php echo '<h3>Competitiva 4 personas: '. count($personasCuatroCompetitiva).'</h3>';?>
    <?php
    $contadorRecreDos=1;
    ?>
    <table class="table table-sm">
        <tr>
            <th></th>
            <th>ID equipo sistema</th>
            <th>DNI</th>
            <th>nombre y apellido</th>
            <th>DNI Capitan</th>
            <th>Nombre Capitan</th>
            <th>Acepto deslinde de responsabilidades</th>
            <th>Retiro kit</th>
        </tr>
        <tbody>
        <?php

        //$contador=1;

        foreach($personasCuatroCompetitiva as $persona){

            ?>
            <tr>
                <td><?php echo $contadorRecreDos; ?></td>
                <td><?php echo $persona->equipo()->idEquipo; ?></td>
                <td><?php echo $persona->dni(); ?></td>
                <td><?php echo strtolower($persona->apellidoPersona.' '.$persona->nombrePersona); ?></td>
                <td><?php echo $persona->dniCapitan(); ?></td>
                <td><?php echo $persona->nombreCapitan();?></td>
                <td></td>
                <td></td>


            </tr>

            <?php
            $contadorRecreDos++;
        }

        ?>

        </tbody>
    </table>



</div>