<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use app\custom\GlypIcon;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Movimiento */

$this->title = "Mostrar : ".$model->idmovimiento;
$this->params['breadcrumbs'][] = ['label' => 'Almacen', 'url' => ['/dash/almacen/']];
$this->params['breadcrumbs'][] = ['label' => 'Entradas', 'url' => ['/movimiento']];
$this->params['breadcrumbs'][] = "Mostrar : ".$model->idmovimiento;

$attributes = [
    [
        'group'=>true,
        'label'=>'INFORMACION GENERAL ENTRADA #'.$model->idmovimiento,
        'rowOptions'=>['class'=>'info']
    ],
  [
     'columns' => [
            [
                'attribute'=>'fecha_movimiento', 
                'displayOnly'=>true,
                'labelColOptions'=>['style'=>'width:15%'],
                'valueColOptions'=>['style'=>'width:10%'], 

            ],
            [
                'attribute'=>'fk_proveedor', 
                'displayOnly'=>true,
                'labelColOptions'=>['style'=>'width:15%'],
                'value'=> $model->fkProveedor->razon_social, 
                'valueColOptions'=>['style'=>'width:40%'], 
            ],
             [
                'attribute'=>'total_mvto', 
                'displayOnly'=>true,
                'labelColOptions'=>['style'=>'width:10%'],
                'valueColOptions'=>['style'=>'width:10%'], 
            ],
            
           ],
  

],  [
        'columns' => [
         [
                'attribute'=>'folio_oc', 
                'displayOnly'=>true,
                'labelColOptions'=>['style'=>'width:15%'],
                'valueColOptions'=>['style'=>'width:10%'], 
            ],
         
           
            [
                'attribute'=>'fk_tipo_documento', 
                'displayOnly'=>true,
                'value'=> $model->fkTipoDocumento->tipo_documento, 
                'labelColOptions'=>['style'=>'width:15%'],
                'valueColOptions'=>['style'=>'width:40%'], 
            ],
            [
                'attribute'=>'folio_dcto', 
                'displayOnly'=>true,
                'labelColOptions'=>['style'=>'width:10%'],
                'valueColOptions'=>['style'=>'width:10%'], 
            ],
           
            
            
           ],],
           [
        'group'=>true,
        'label'=>'INFORMACION DE EDICION',
        'rowOptions'=>['class'=>'info']
    ],
    ['columns' => [
             ['attribute'=>'created_at', 'displayOnly'=>true,'valueColOptions'=>['style'=>'width:30%'], ],
             ['attribute'=>'created_by', 'displayOnly'=>true, ],
        ],
    ],
    ['columns' => [
             ['attribute'=>'updated_at', 'displayOnly'=>true,'valueColOptions'=>['style'=>'width:30%'], ],
             ['attribute'=>'updated_by', 'displayOnly'=>true, ],
        ],
    ],
          
];

// View file rendering the widget



?>
<div class="movimiento-view">



<?=  DetailView::widget([
    'model' => $model,
    'attributes' => $attributes,
    'mode' => 'view',
    'bordered' => true,
    'striped' => false,
    'condensed' => false,
    'responsive' => false,
    'hover' => true,
    'hAlign'=>true,
    'vAlign'=>true,
    'fadeDelay'=>500,
    'container' => ['id'=>'kv-movimiento'],]);
    ?>



<h1>DETALLE </h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],
            'idmovimiento_detalle',
            'fk_material_almacen',
            'fkMaterialAlmacen.material_almacen',
            'costo',
            'iva',
            'cantidad',
            [   'attribute'=>'total',
                'value'=> function($model){
                    return   Yii::$app->formatter->asDecimal($model->total*1.16, 2);
                },
            ],
        ],
    ]); ?>
</div>
