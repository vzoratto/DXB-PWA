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
<?php
$dni = "";
$rol = "";
$mensaje="";
if (!Yii::$app->user->isGuest) {
    $usulog = \app\models\Usuario::findOne($_SESSION["__id"]);
    if ($usulog->idRol == 1 && $usulog->activado==0) {
        //Yii::$app->user->logout();
        $mensaje="No tiene la cuenta activada, por favor dirijase a su correo para activarla.";
        return $this->render('error', ['mensaje' => $mensaje]);
        
    }elseif ($usulog->idRol != 1) {
        app\controllers\UsuarioController::redirect(["site/admin"]);
        //Yii::$app->getResponse()->redirect(Url::to([site/admin]));
    }
}
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
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            
            ['label' => 'Registro', 'url' => 'index.php?r=site/registro', 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Iniciar Sesion', 'url' => 'index.php?r=site%2Flogin', 'visible' => Yii::$app->user->isGuest],

            ],
            ]);
                NavBar::end();
                if(!Yii::$app->user->isGuest ){
              echo Nav::widget([
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->dniUsuario. ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
                ]);
        
    
    NavBar::end();}
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
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


