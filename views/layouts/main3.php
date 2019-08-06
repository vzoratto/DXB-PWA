<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title>Area Gestores</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Area Gestion de datos',
        'brandUrl' => 'index.php?r=site%2Fgestor',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => [
            ['label' => 'Equipos', 'url' => ['/equipo/index']],
            ['label' => 'Participantes','items' => [
                ['label' => 'Ver Todos', 'url' => ['/carrerapersona/index']],
                ['label' => 'En Espera', 'url' => ['/listadeespera/index']],
                ['label' => 'Fichas Medicas', 'url' => ['/fichamedica/index']],
                ['label' => 'Inscribir Invitado', 'url' => ['/invitado/index']],
                ['label' => 'Inscripcion Corredor', 'url' => ['/inscripcion/index']],
                ['label' => 'Entrega de Kit', 'url' => ['carrerapersona/kit']],
			],
			],
			['label' => 'Encuesta','items' => [
                ['label' => 'Crear Encuesta', 'url' => ['/encuesta/index']],
                ['label' => 'Resultados Encuesta', 'url' => ['/respuesta/index']],

			],
        ],
        ['label' => 'Pagos','items' => [
            ['label' => 'Pagos ver todos', 'url' => ['/pago/index']],
            ['label' => 'Ingresar un pago', 'url' => ['/pago/create1']],
            ['label' => 'Control de pagos', 'url' => ['/controlpago/index']],
            ['label' => 'Estado del pago', 'url' => ['/estadopagoequipo/index']],
            ['label' => 'Pagos no abonados', 'url' => ['/estadopagoequipo/index1']],
            ['label' => 'Activar equipos', 'url' => ['/estadopagoequipo/index2']],
            ['label' => 'Importe inscripcion', 'url' => ['/importeinscripcion/index']],
            ['label' => 'Fechas del evento', 'url' => ['/fechacarrera/index']],
            ],
          ],
          ['label' => 'Reemplazos','items' => [
            ['label' => 'Cambia capitán', 'url' => ['/equipo/validacap']],
            ['label' => 'Cambia corredor', 'url' => ['/equipo/validacorredor']],
            ],
          ],
          !Yii::$app->user->isGuest ?(
            ['label' =>"<i class='glyphicon glyphicon-user ml-30 ml-sm-0' aria-hidden='true'></i>",'items' => [
              ['label' => 'Cambiar contraseña', 'url' => 'index.php?r=site/cambiapass'],
              ['label' => 'Cerrar sesión', 'url' => 'index.php?r=site%2Flogout', 'linkOptions' => ['data-method' => 'post']],
            ],
         ]):'',
        ],
    ]);
    NavBar::end();
    ?>


    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Desafio por Barda <?= date('Y') ?></p>

        <p class="pull-right">Desarrollado por Nosotros </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
