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
            'contentOptions' => ['width' => '50px;' ],],

            
            'idproyecto',
            'proyecto',
            'escala',
            'created_at',
            'fecha_entrega',
            'precio',
            [ 
               'attribute'=> 'fk_cliente',
               'value' => 'fkCliente.nombre_razon_social',
            ],
             [ 
                 'attribute' => 'complejidad',
                'value'=>'fkNivelComplejidad.cname',
                'header'=> 'N. Complejidad',
            ],
             [ 
                 'header'=>'Estatus',
               'attribute'=> 'st_terminado',
               'value' => 'sstterminado',
            ],
            ['class' => 'yii\grid\ActionColumn',
            // 'template' => '{update}{delete}',
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
];

$gridColumns1 = [

            'idproyecto',
            'proyecto',
            'escala',
            'created_at',
            'fecha_entrega',
            'precio',
            [ 
               'attribute'=> 'fk_cliente',
               'value' => 'fkCliente.nombre_razon_social',
            ],
             [ 
                 'attribute' => 'complejidad',
                'value'=>'fkNivelComplejidad.cname',
                'header'=> 'N. Complejidad',
            ],
             [ 
             'header'=>'Estatus',
               'attribute'=> 'st_terminado',
               'value' => 'sstterminado',
            ],


];
?>
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
