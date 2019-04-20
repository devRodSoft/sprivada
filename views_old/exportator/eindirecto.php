<?php

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\search\CformaPagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$gridColumns1 = [
            'idcaja_chica',
            'importe',
            'fkCformaPago.cforma_pago',
            'fkCsubTipoGasto.fkCtipoGasto.ctipo_gasto',
            'fkCsubTipoGasto.csub_tipo_gasto',
            'fkCentroCosto.nombre_centro',
            'observacion',
            'fkCuentapagar.stpagado',
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
