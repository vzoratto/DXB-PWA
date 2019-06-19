<?php
use kartik\export\ExportMenu;
use kartik\grid\GridView;


echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        'idEncuesta',
        'encTitulo',
        'encDescripcion',
        'encPublica',
    ],
    'fontAwesome' => true,

    'dropdownOptions' => [
        'label' => 'Export All',
        'class' => 'btn btn-default'
    ]
]) . "<hr>\n".
GridView::widget([
'dataProvider' => $dataProvider,
'columns' => [
    ['class' => 'kartik\grid\SerialColumn'],
    'idEncuesta',
    'encTitulo',
    'encDescripcion',
    'encPublica',
],
])
    ?>