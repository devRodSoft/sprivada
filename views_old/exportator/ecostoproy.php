<?php

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\search\CformaPagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$gridColumns = [
    
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ]],
             [ 
                 'header'=>'idproyecto',
               'attribute'=> 'fk_proyecto_costo',
               'value' => 'fkProyectoCosto.fk_proyecto',
            ],
              [ 
              'header'=>'movimiento',
               'attribute'=> 'fk_proyecto_costo',
               'value' => 'fkProyectoCosto.fk_movimiento',
            ],
              'codigo' , 
              'material',
              'familia',
              'costo:decimal',
            'cantidad:decimal',
            ['attribute'=>'total',
            'value'=> 'ttotal',
              'format'=>'decimal']
            
            
];

$gridColumns1 = [[   'header'=>'idproyecto', 'attribute'=> 'fk_proyecto_costo', 
'value' => 'fkProyectoCosto.fk_proyecto', ], 
['header'=>'movimiento', 'attribute'=> 'fk_proyecto_costo', 'value' => 'fkProyectoCosto.fk_movimiento', ], 
'codigo' , 'material', 'familia', 'costo:decimal', 'cantidad:decimal', 
['attribute'=>'total', 'value'=> 'ttotal', 'format'=>'decimal'] ]; ?>
<div class="cforma-pago-index">
<?php
   echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns1,
    'fontAwesome' => true,
    'dropdownOptions' => [
        'label' => 'Exportar',
        'class' => 'btn btn-default'
    ]
]) . "<hr>\n".

GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
]);
?>
</div>
