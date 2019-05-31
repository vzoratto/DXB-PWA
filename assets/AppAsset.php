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
        'css/botonSwicht.css',
<<<<<<< HEAD
        'js/pickadate/themes/default.css',
        'js/pickadate/themes/classic.date.css',

=======
>>>>>>> parent of 8ab0370... Revert "Merge branch 'master' of https://github.com/RArielVillalobos/carrera into liliana-modif"
    ];
    public $js = [
        'js/botonesFormulario.js',
        'js/pickadate/picker.js',
        'js/pickadate/picker.date.js',
        'js/pickadate/legacy.js',
        'js/pickadate/app.js',



    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
