<br>
<br>
<div class="equipo-index reglamento-container">
    <?php echo '<h3></h3>';?>
    <?php
    $contadorRecreDos=1;
    ?>
    <table class="table table-sm">
        <tr>
            <th></th>
            <th>Referencia pago</th>
            <th>Importe Pagado</th>
            <th>Entidad pago</th>
            <th>Fecha chequeado</th>
            <th>Nombre y Apellido</th>
            <th>Nombre Equipo</th>
            <th>Comprobante</th>

        </tr>
        <tbody>
        <?php

        $contador=1;

        foreach($pagos as $pago){

            ?>
            <tr>
                <td><?php echo $contador++ ?></td>
                <td><?php echo $pago->pago->idPago; ?></td>
                <td><?php echo $pago->pago->importePagado; ?></td>
                <td><?php echo $pago->pago->entidadPago; ?></td>
                <td><?php echo $pago->fechachequeado; ?></td>
                <td><?php echo $pago->pago->persona->apellidoPersona .' ' .$pago->pago->persona->nombrePersona ?></td>
                <td><?php echo $pago->pago->equipo->nombreEquipo?></td>
                <td><?php echo yii\bootstrap\Html::img($pago->pago->imagenComprobante,['width'=>'50']); ?></td>



            </tr>

            <?php
            $contadorRecreDos++;
        }

        ?>

        </tbody>
    </table>






</div>