<?php
/**
 * Created by PhpStorm.
 * User: ariel
 * Date: 29/08/19
 * Time: 23:51
 */
echo '<br>';
echo '<br>';
echo '<br>';

echo 'equipos habilitados '.count($equipos);
echo '<br>';
echo 'equipos incompletos '. $equiposIncompletos;
echo '<br>';
echo 'cantidad de personas que faltan inscribirse segun equipo:'.$personasFaltanInscribirse;
echo '<br>';
$usuarios=[];
foreach ($dniCapitanes as $dnicapitan){
    $usuario=\app\models\Usuario::findOne(['dniUsuario'=>$dnicapitan]);
    $usuarios[]=$usuario;


}
echo '<h3>Mail capitanes equipos incompletos total: '. count($usuarios).'</h3>';
foreach($usuarios as $usuario){
    echo  strtolower($usuario->mailUsuario);
    echo '<br>';
}

?>
