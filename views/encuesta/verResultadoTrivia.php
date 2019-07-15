<?php

use yii\helpers\Url;

?>
<br><br><br>
<div class="container reglamento-container">
<pre><?php print_r($resultadoTrivia) ?></pre>

<a title="Volver a la responder trivia" class="btn btn-dark" href="<?= Url::toRoute('encuesta/trivia')?>">Volver a responder trivia</a>
</div>