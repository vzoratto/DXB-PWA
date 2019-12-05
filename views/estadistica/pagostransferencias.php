<br>
<br>
<?php
use yii\widgets\ActiveForm;;

?>
<div class="equipo-index reglamento-container">
    <?php echo '<h3></h3>';?>
    <?php
    $contadorRecreDos=1;
    ?>
    <br>
    <div class="container">
        <?php $form = ActiveForm::begin(
            [
                'method'=>'get',
                "action"=>"index.php?r=estadistica%2Fpagostransferencias",
            ]
        ); ?>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Entidad:</label>
                        <input class="form-control" type="text" name="entidad" value="<?php if(isset($entidad)){ echo $entidad;}?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Pago:</label>
                        <input class="form-control" type="number" name="importe_pagado" value="<?php if(isset($importe_pagado)){ echo $importe_pagado;}?>">
                    </div>
                </div>
                <br>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>

                <?php ActiveForm::end(); ?>

            </div>



    </div>
    <div class="container">
        <h4> Resultados:<?php echo count($pagos);?></h4>

    </div>
    <table class="table table-sm">
        <tr>
            <th></th>
            <th>Referencia pago</th>
            <th>Importe Pagado</th>
            <th>Entidad pago</th>
            <th>Fecha chequeado</th>
            <th>Nombre y Apellido</th>
            <th>Dni</th>
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
                <td><?php echo $pago->pago->persona->usuario->dniUsuario;?></td>
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