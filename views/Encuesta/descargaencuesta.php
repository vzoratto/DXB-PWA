<?php

use app\models\Encuesta;


        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [
                'Users' => [
                    'class' => 'codemix\excelexport\ActiveExcelSheet',
                    'query' => $encuesta,
                ]
            ]
        ]);

        $file->send('user.xlsx');
    ?>