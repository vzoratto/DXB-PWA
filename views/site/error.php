<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

if (!empty($mensaje)) {
    $msg = $mensaje;
} else {
    $msg = "No se puede acceder a esta pagina";
}

$this->title = "Atencion!";
?>
<div class="site-error" align="center">


    <img src="registro/alerta.png" style="margin:20px;max-width: 150px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-danger">
        <?php echo nl2br(Html::encode($msg));?>
    </div>
    <div class="alert alert-info">
        <?php echo "carreraxbarda@gmail.com";?>
    </div>

</div>