<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\search\OrdenCompraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de Ordenes de Compra";
$this->params['breadcrumbs'][] = ['label' => 'Egresos', 'url' => ['/dash/egresos/']];
$this->params['breadcrumbs'][] = 'Ordenes de  Compra';
$gridColumns1 = ['fkOrdenCompra.folio', 'fkOrdenCompra.fecha_recepcion', 'fkOrdenCompra.solicitante', 
'fkOrdenCompra.fkProveedor.razon_social', 'fkOrdenCompra.utilizacion', 'fkOrdenCompra.observacion', 'codigo'
, 'descripcion', 'cantidad', 'um', ];
?>
<div class="orden-compra-index">

     <h1><?php echo Html::encode($this->title); 

      echo "<div class='fright'>".ExportMenu::widget([
    'dataProvider' => $dataExport,
    'columns' => $gridColumns1,
    'fontAwesome' => true,
    'filename'=>'ordenCompra',
    'target'=> ExportMenu::TARGET_BLANK,
    'dropdownOptions' => [
        'label' => 'Exportar',
        'class' => 'btn btn-default'
    ]
]) . "</div><div class='romper'></div>\n";  ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            // 'id_orden_compra',
            'folio',
            'fecha_compra:datetime',
            'fecha_recepcion:datetime',
            'observacion',
            // 'solicitante',
            // 'utilizacion',
            // 'fk_proveedor',
            // 'fk_compra_producto',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{delete}',
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
</div>
