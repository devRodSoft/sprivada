<?php

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\search\CformaPagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$gridColumns = [
    
            'fkOrdenCompra.folio',
            'fkOrdenCompra.fecha_recepcion',
            'fkOrdenCompra.solicitante',
            'fkOrdenCompra.fkProveedor.razon_social',
            'fkOrdenCompra.utilizacion',
            'codigo',
            'descripcion',
            'cantidad',
            'um',
            
            
];


?>
<div class="cforma-pago-index">
<?php
   echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
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
