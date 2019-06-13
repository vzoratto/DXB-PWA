<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/responsive.css',
        'css/botonSwicht.css',
        'js/pickadate/themes/default.css',
        'js/pickadate/themes/classic.date.css',
    ];
    public $js = [
        'js/botonesFormulario.js',
        'js/pickadate/picker.js',
        'js/pickadate/picker.date.js',
        'js/pickadate/legacy.js',
        'js/pickadate/app.js',
        'js/cambiarIdioma.js',
        'js/main.js',
        'js/countdownClock.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
