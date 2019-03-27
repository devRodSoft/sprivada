<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\custom\GlypIcon;
use app\models\Produccion;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\search\DesarrolloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Produccion proyecto: ".$proyecto->proyecto;
$this->params['breadcrumbs'][] = ['label' => 'Produccion', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Actualizar :".$proyecto->idproyecto;

 

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
                'filterType'=>GridView::FILTER_SELECT2,
                //'filter'=>ArrayHelper::map(Produccion::find()->where(['nivel'=>1])->orderBy('nodo')->asArray()->all(), 'idproduccion', 'produccion'), 
                'filter'=>$n1,
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Nivel 1 '],
    ],

              ['attribute'=>'n2',
            'header'=>'Nivel 2', 
             'value'=>'sn2',
              'filterType'=>GridView::FILTER_SELECT2,
                //'filter'=>ArrayHelper::map(Produccion::find()->where(['nivel'=>2])->orderBy('nodo')->asArray()->all(), 'idproduccion', 'produccion'), 
                'filter'=>$n2, 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Nivel 2'],
             ],

              ['attribute'=>'n3',
            'header'=>'Nivel 3', 
             'value'=>'sn3',
              'filterType'=>GridView::FILTER_SELECT2,
                //'filter'=>ArrayHelper::map(Produccion::find()->where(['nivel'=>3])->orderBy('nodo')->asArray()->all(), 'idproduccion', 'produccion'), 
                'filter'=>$n3,
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Nivel 3'],
             ],
             
              ['attribute'=>'fk_produccion',
            'header'=>'Descripcion', 
             'value'=>'fkProduccion.produccion',],
             'avance_ant',
           [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'avance', 
                'readonly'=>function($model, $key, $index, $widget) {
                    return false;// return (!$model->status); // do not allow editing of inactive records
                },
                'editableOptions'=>[
                    'preHeader'=>'',
                    'header'=>'Modificar Avance', 
                    'inputType'=>\kartik\editable\Editable::INPUT_TEXT ,
                    // 'formOptions' => ['action' => ['/desarrollo/update']],
                ],
                'hAlign'=>'right', 
                'vAlign'=>'middle',
                'width'=>'7%',
                'format'=>['decimal', 2],
                'pageSummary'=>true
            ],

            
            
            // 'fk_proyecto',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by', 
            ];
?>
<div class="desarrollo-valor-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
    'id' => 'kv-grid-demo',
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    'pjax'=>false,
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>false, // pjax is set to always true for this demo
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
