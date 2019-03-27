<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\search\CajaChicaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = "Lista de Indirectos";
$this->params['breadcrumbs'][] = ['label' => 'Egresos', 'url' => ['/dash/egresos/']];
$this->params['breadcrumbs'][] = 'Indirectos';
$gridColumns1 = ['idcaja_chica', 'importe','created_at', 'fkCformaPago.cforma_pago', 'fkCsubTipoGasto.fkCtipoGasto.ctipo_gasto',
 'fkCsubTipoGasto.csub_tipo_gasto', 'fkCentroCosto.nombre_centro', 'observacion', 'fkCuentapagar.stpagado', ]; 
 ?>

<div class="caja-chica-index">

    <div class="proyecto-index">

    <h1><?php echo Html::encode($this->title); 

      echo "<div class='fright'>".ExportMenu::widget([
    'dataProvider' => $dataExport,
    'columns' => $gridColumns1,
    'fontAwesome' => true,
    'filename'=>'indirectos',
    'target'=> ExportMenu::TARGET_BLANK,
    'dropdownOptions' => [
        'label' => 'Exportar',
        'class' => 'btn btn-default'
    ]
]) . "</div><div class='romper'></div>\n";?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            [ 'attribute' => 'idcaja_chica' , 'value' => 'idcaja_chica' ],
            'caja_chica',
            'fecha_comprachica:date',
            'importe:decimal',
            ['attribute'=> 'fk_cforma_pago' , 'value' => 'fkCformaPago.cforma_pago']  ,
            ['attribute'=> 'fk_csub_tipo_gasto' , 'value' => 'fkCsubTipoGasto.csub_tipo_gasto']  ,
            ['attribute'=> 'fk_centro_costo' , 'value' => 'fkCentroCosto.nombre_centro']  ,
            ['attribute'=> 'fk_tipo_gasto' , 'value' => 'fkCsubTipoGasto.fkCtipoGasto.ctipo_gasto']  ,


            // 'observacion',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create'],[ 'title'=> 'Nuevo Indirecto']) ,

           
                'buttons' => [
                 'update' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>' ,$url ,[  'title'=> 'Editar Indirecto']); 
                 }            
                    
               
              ],
                'contentOptions' => ['width' => '100px;' , 'align' => 'center' ],
            ],
        ],
    ]); ?>
</div>
