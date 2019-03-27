<?php

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\search\CformaPagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$gridColumns = [
    
             // 'idmaterial_almacen',
            'codigo',
            'material_almacen',
            'familia',
            'existencia',
            'costo',
            'costo_iva',
            'fkUm.um',
            
            
];

$gridColumns1 = [
           // 'idmaterial_almacen',
            'codigo',
            'material_almacen',
            'familia',
            'existencia',
            'costo',
            'costo_iva',
            'fkUm.um',


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
