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
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

  <?php
  NavBar::begin([
      'options' => [
          'class' => 'navbar-fixed-top sticky',
          'id' => 'bardasHeader'
      ],
  ]);

  echo Nav::widget([
      'options' => ['class' => 'navbar-nav navbar-right'],
      'encodeLabels' => false,
      'items' => [
          ['label' => 'Inicio', 'url' => ['/site/index', '#' => 'inicio']],
          ['label' => 'Premios', 'url' => ['/site/index', '#' => 'premios']],
          ['label' => 'Colaboradores', 'url' => ['/site/index', '#' => 'colaboradores']],
          ['label' => 'Reglamento', 'url' => ['/site/index', '#' => 'reglamento']],
          ['label' => 'Contacto', 'url' => ['/site/index', '#' => 'contacto']],
          ['label' => 'Iniciar Sesion', 'url' => 'index.php?r=site%2Flogin', 'visible' => Yii::$app->user->isGuest],
          ['label' => 'Inscripcion', 'url' => 'index.php?r=inscripcion/index', 'visible' => !Yii::$app->user->isGuest],
          !Yii::$app->user->isGuest ?(
          ['label' =>"<i class='fa fa-user-circle-o ml-30 ml-sm-0' aria-hidden='true'></i>",'items' => [
            ['label' => 'Mi perfíl', 'url' => 'index.php?r=usuario%2Fperfil'],
            ['label' => 'Cambiar contraseña', 'url' => 'index.php?r=site/cambiapass'],
            ['label' => 'Cerrar sesión', 'url' => 'index.php?r=site%2Flogout', 'linkOptions' => ['data-method' => 'post']],
          ],
       ]):'',

      ],
  ]);
  NavBar::end();
  ?>

        <?= Alert::widget() ?>
        <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
