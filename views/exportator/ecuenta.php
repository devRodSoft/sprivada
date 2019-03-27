<?php

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\search\CformaPagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$gridColumns = [
           'idcuenta_pagar',
            'folio_dcto',
            'tipo_dcto',
            'fecha_vencimiento:date',
            [
              'header'=>'Cantidad',
              'attribute' =>'deuda',
               'value'=>'deuda',  
            ],
            [
              'header'=>'X pagar',
              'attribute' =>'deuda',
              'value'=> function($model){
                    return ($model->deuda - $model->pagado);},
            ],
            'pagado',
            'fkMetodoPago.metodo_pago',
            'fkProveedor.razon_social',
            'observacion',
            'stpagado',
];

$gridColumns1 = ['idcuenta_pagar', 'folio_dcto', 'tipo_dcto', 'fecha_vencimiento:date',
 ['header'=>'Cantidad', 'attribute' =>'deuda', 'value'=>'deuda', ], 
 ['header'=>'X pagar', 'attribute' =>'deuda', 
 'value'=> function($model){return ($model->deuda - $model->pagado);}, ]
 , 'pagado', 'fkMetodoPago.metodo_pago', 'fkProveedor.razon_social', 'observacion', 'stpagado', ]; ?>

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
