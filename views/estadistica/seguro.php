

<br>
<br>
<br>
<br>
<br>
<?php echo '<h3>Recreativa 2 personas: '. count($personasConfirmadas).'</h3>';?>
<table class="table table-sm">
    <tr>

        <th>Nombre y Apellido</th>
        <th>DNI</th>
        <th>Fecha Nacimiento</th>

    </tr>
    <tbody>
    <?php

    //$contador=1;

    foreach($personasConfirmadas as $persona){
            $usu=\app\models\Usuario::findOne(['idUsuario'=>$persona->idUsuario]);

        ?>
        <tr>

            <td><?php echo strtolower($persona->apellidoPersona.' '.$persona->nombrePersona); ?></td>
            <td><?php echo $usu->dniUsuario ?></td>
            <td><?php echo $persona->fechaNacPersona ?></td>



        </tr>

        <?php

    }

    ?>

    </tbody>
</table>
<hr>