<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

if (!empty($mensaje)) {
    $msg = $mensaje;
} else {
    $msg = "No se puede acceder a esta pagina";
}

$this->title = "Administracion!";
 $categoriesOptions = [
    '1' => ['id' => '1', 'name' => 'PHP', 'prefix_tree' => ''],
    '2' => ['id' => '2', 'name' => 'CodeIgniter', 'prefix_tree' => '&nbsp;&nbsp;&nbsp;'],
    '3' => ['id' => '3', 'name' => 'Yii', 'prefix_tree' => '&nbsp;&nbsp;&nbsp;'],
    '4' => ['id' => '4', 'name' => 'Yii 1', 'prefix_tree' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'],
    '5' => ['id' => '5', 'name' => 'Yii 2', 'prefix_tree' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'],
    '6' => ['id' => '6', 'name' => 'Laravel', 'prefix_tree' => '&nbsp;&nbsp;&nbsp;'],
]; ?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field('modelfield', 'categories')->checkboxList([
    \yii\helpers\ArrayHelper::map($categoriesOptions, 'id', 'name'),
    
        'class' => 'categories-container',
        'item' => function ($index, $label, $name, $checked, $value) use ($categoriesOptions) {
            return '<div class="checkbox">'.
                $categoriesOptions[$value]['prefix_tree'].
                \yii\helpers\Html::checkbox($name, $checked, ['label' => $label, 'value' => $value]).
            '</div>';
        }
    ]);
 ?>
 

 
<?php ActiveForm::end(); ?>




?>