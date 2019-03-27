<?php

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\search\CformaPagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


 $gridColumns1 = ['fkMovimiento.fecha_movimiento', 'fkMovimiento.fkTipoDocumento.tipo_documento', 
 'fkMovimiento.folio_dcto', 'fkMovimiento.fkProveedor.razon_social', 'fkMovimiento.folio_oc',
  'fkMovimiento.stpagado:boolean', 'fkMovimiento.fkProyecto.proyecto', 'fkMovimiento.total_mvto',
   'fk_material_almacen', 'fkMaterialAlmacen.material_almacen', 'cantidad', 'costo', ];

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
