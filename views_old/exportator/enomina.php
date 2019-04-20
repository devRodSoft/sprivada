<?php

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\search\CformaPagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$gridColumns1 = [
           // 'idmaterial_almacen',
            'fkPagos.folio',
            'fkPagos.created_at',
            'fkPagos.nombre',
            'proyecto',
            'avance',
            'porcentaje_pago',
            'monto',
            'monto_total',
            'fkPagos.created_by',


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
    'columns' => $gridColumns1,
]);
?>
</div>
