<?php
/* --------------------------------------------------------------------------------------
Vista para mostrar graficos de respuestas de las encuestas. No esta terminado ni operativo.
-----------------------------------------------------------------------------------------
*/
use miloschuman\highcharts\Highcharts;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\controllers\EncuestaController;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Encuesta */
/* @var $form yii\widgets\ActiveForm */
/* @var $encuestas app\models\Encuesta */
if($encuestas!=""){
$encuestas= ArrayHelper::map($encuestas, 'idEncuesta', 'encTitulo');
}
?>
<h3>Análisis de resultados</h3>
<?php $form=ActiveForm::begin([
    'action'=>Url::toRoute('encuesta/grafico'),
    'method'=>'post',
    'id'=>'select_encuesta',
]);?>

<?= $form->field($model, 'idEncuesta')->widget(Select2::className(), [
        'data'=>$encuestas,
        'options'=> [
            'placeholder'=> 'Seleccione una opcion...',
            'onchange'=>'function(){$("#select_encuesta").submit();}',   
        ],
    ])->label('Encuesta');
?>
<?= Html::submitButton('Ver Grafica', ['class'=>'btn btn-primary'])?>

<?php ActiveForm::end();?>
<?= Highcharts::widget([
   'options' => [
      'title' => ['text' => 'Analisis de Encuesta'],
      'xAxis' => [
         'categories' => ['Apples', 'Bananas', 'Oranges']
      ],
      'yAxis' => [
         'title' => ['text' => 'Fruit eaten']
      ],
      'series' => [
         ['name' => 'Jane', 'data' => [1, 0, 4]],
         ['name' => 'John', 'data' => [5, 7, 3]]
      ]
   ]
]);

?>
