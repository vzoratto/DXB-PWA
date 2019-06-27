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
    <title>Area Administrativa</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Area Administrativa',
        'brandUrl' => 'index.php?r=site%2Fadmin',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [

            ['label' => 'Listados ABM','items' => [
                ['label' => 'Usuario', 'url' => ['/usuario/index']],
                ['label' => 'Gestor', 'url' => ['/gestores/index']],
                ['label' => 'Corredor', 'url' => ['/persona/index']],
                ['label' => 'corredor Invitado', 'url' => ['/invitado/index']],
                ['label' => 'Inscripcion', 'url' => ['/inscripcion/index']],
                ],
              ],
                 ['label' => 'Dar Permisos','items' => [
                    ['label' => 'Administrador', 'url' => ['/gestores/altaadmin']],
                    ['label' => 'Gestor', 'url' => ['/gestores/altagestor']],

                 ],
                ],
                ['label' => 'Ver Permisos','items' => [
                   ['label' => 'Administrador', 'url' => ['/gestores/busadmin']],
                   ['label' => 'Gestor', 'url' => ['/gestores/busgestor']],

                  ],
                ],
              ['label' => 'Encuesta','items' => [
                ['label' => 'Crear Encuesta', 'url' => ['/encuesta/index']],
                ['label' => 'Resultados Encuesta', 'url' => ['/respuesta/index']],

			    ],
              ],
                ['label' => 'Pagos','items' => [
                ['label' => 'Pagos ver todos', 'url' => ['/pago/index']],
                ['label' => 'Control de pagos', 'url' => ['/controlpago/index']],
                ['label' => 'Importe inscripcion', 'url' => ['/importeinscripcion/index']],
                ],
              ],
            Yii::$app->user->isGuest ? (
                ''
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->dniUsuario . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm().
                 '</li>'
            )
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
