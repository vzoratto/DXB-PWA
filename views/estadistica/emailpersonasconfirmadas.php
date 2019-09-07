<br>
<br>
<div class="equipo-index reglamento-container">
    <?php echo '<h3>Email de personas confirmadas(pagas): '. count($personasConfirmadas).'</h3>';?>
    <?php
    $contador=1;
    foreach ($personasConfirmadas as  $persona){
        echo $persona->mailPersona;
        echo '<br>';
        //$contador++;
    }
    echo '<hr>';
    
    ?>





</div>