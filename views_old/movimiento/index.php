<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\search\MovimientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de  Entradas";
$this->params['breadcrumbs'][] = 'Entrada';

 $gridColumns1 = ['fkMovimiento.fecha_movimiento', 'fkMovimiento.fkTipoDocumento.tipo_documento', 
 'fkMovimiento.folio_dcto', 'fkMovimiento.fkProveedor.razon_social', 'fkMovimiento.folio_oc',
  'fkMovimiento.stpagado:boolean', 'fkMovimiento.fkProyecto.proyecto', 'fkMovimiento.total_mvto',
   'fk_material_almacen', 'fkMaterialAlmacen.material_almacen', 'cantidad', 'costo', ];

?>
<div class="movimiento-index">

     <h1><?php echo Html::encode($this->title); 

      echo "<div class='fright'>".ExportMenu::widget([
    'dataProvider' => $dataExport,
    'columns' => $gridColumns1,
    'fontAwesome' => true,
    'filename'=>'entradas',
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

            'idmovimiento',
            'fecha_movimiento',
            'fkTipoDocumento.tipo_documento',
            'folio_dcto',
            'folio_oc',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            'fkProveedor.razon_social',
            'total_mvto',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{delete}',
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
</div>
