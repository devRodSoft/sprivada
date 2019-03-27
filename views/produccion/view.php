<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\ProgressBar;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Produccion;
use app\custom\GlypIcon;
/* @var $this yii\web\View */
/* @var $model app\models\DesarrolloValor */

$this->title = "Mostrar : ".$model->idproduccion_valor;
$this->params['breadcrumbs'][] = ['label' => 'Produccion', 'url' => ['/produccion/']];
$this->params['breadcrumbs'][] = "Mostrar : ".$model->idproduccion_valor;

$gridColumns = [
            [
                'class'=>'kartik\grid\SerialColumn',
                'contentOptions'=>['class'=>'kartik-sheet-style'],
                'width'=>'36px',
                'header'=>'',
                'headerOptions'=>['class'=>'kartik-sheet-style']
            ],

            // 'iddesarollo_valor',
            ['attribute'=>'n1',
            'header'=>'Nivel1', 
             'value'=>'sn1',
              'width'=>'200px',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Produccion::find()->where(['nivel'=>1])->orderBy('idproduccion')->asArray()->all(), 'idproduccion', 'produccion'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Nivel 1 '
           ],
    ],

              ['attribute'=>'n2',
            'header'=>'Nivel 2', 
             'value'=>'sn2',
             'width'=>'200px',
              'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Produccion::find()->where(['nivel'=>2 , 'st_hoja' => 0])->orderBy('produccion')->asArray()->all(), 'idproduccion', 'produccion'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Nivel 2'],
             ],

              ['attribute'=>'n3',
            'header'=>'Nivel 3', 
             'value'=>'sn3',
             'width'=>'200px',
              'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Produccion::find()->where(['nivel'=>3 , 'st_hoja' => 0 ])->orderBy('produccion')->asArray()->all(), 'idproduccion', 'produccion'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],

            'filterInputOptions'=>['placeholder'=>'Nivel 3'],
             ],
             [
    'class'=>'kartik\grid\BooleanColumn',
    'attribute'=>'st_hoja', 
    'vAlign'=>'middle'
], 
              ['attribute'=>'fk_produccion',
            'header'=>'Descripcion', 
             'value'=>'fkProduccion.produccion',],
             'avance_ant',
              'avance', 
            ];

 // d($general);
 // die();
?>

 <?php 
 // d($proyecto);
  if($general[0]['avance']=="100"&&$general[1]['avance']=="100"&&$proyecto->fase==1)
    echo GlypIcon::aglyp('Pasar a Siguiente Fase','glyphicon-plus', ['sigfase' , 'idproyecto'=>$proyecto->idproyecto], ['class' => 'btn btn-success' ,'title'=> 'Siguiente Fase Produccion']);

 ?>
 <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">RESUMEN</a></li>
     <li role="presentation"><a href="#gendet" aria-controls="gendet" role="tab" data-toggle="tab">ACUMULADO DETALLE</a></li>
    <li role="presentation"><a href="#datos" aria-controls="datos" role="tab" data-toggle="tab">DATOS</a></li>
    <!-- <li role="presentation"><a href="#produccion" aria-controls="produccion" role="tab" data-toggle="tab">PRODUCCION</a></li> -->
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="general"> 
		<?= ProgressBar::widget(['label'=>'descripcion', 'value'=>'avance' , 'summary' => true, 'items' =>[$general]]) ?>
	</div>
    <div role="tabpanel" class="tab-pane fade in" id="gendet"> 
        <?= ProgressBar::widget(['label'=>'descripcion', 'value'=>'avance' , 'summary' => false, 'grouped' =>true,'items' =>[$general]]) ?>
  </div>


<div role="tabpanel" class="tab-pane fade in" id="datos"> 
  <?= GridView::widget([
    'id' => 'kv-grid-demo',
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    // set your toolbar
    'toolbar'=> [
        '{export}',
    ],
    // set export properties
    'export'=>[
        'fontAwesome'=>true
    ],
    // parameters from the demo form
    'bordered'=>true,
    'striped'=>true,
    'condensed'=>false,
    'responsive'=>true,
    'hover'=>true,
    // 'showPageSummary'=>$pageSummary,
    'panel'=>[
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=>'<i class="glyphicon glyphicon-check"></i>  Produccion',
    ],
    'persistResize'=>false,
    // 'exportConfig'=>$exportConfig,
]);


?>
  </div>
</div>