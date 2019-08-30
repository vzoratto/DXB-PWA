<p>hola</p>

<?php
 echo 'total '.count($usuariosNoInscriptos);
 echo '<br>';

 foreach ($usuariosNoInscriptos as $usuario){
     echo  strtolower($usuario->mailUsuario).'<br>';
 }

?>