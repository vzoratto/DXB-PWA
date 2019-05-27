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

$this->title = "Administracion!";
?>