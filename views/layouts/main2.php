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
        'encodeLabels' => false,
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
                ['label' => 'Estadisticas','items' => [
                    ['label' => 'Usuarios no inscriptos', 'url' => ['/estadistica/noinscriptos']],
                    ['label' => 'Estadisticas Generales', 'url' => ['/estadistica/generales']],
                    ['label' => 'Equipos Incompletos sin pagar', 'url' => ['/estadistica/equiposincompletosinpagar']],
                    ['label' => 'Equipos Abonados con participantes en lista de espera', 'url' => ['/estadistica/equiposabonadosparticipanteespera']],
                    ['label' => 'Email capitanes en espera', 'url' => ['/estadistica/capitanesespera']],

                ],
                ],


                ['label' => 'Permisos','items' => [
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
                ['label' => 'Inscripcion', 'url' => ['/inscripcion/index']],
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
