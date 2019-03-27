<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\custom\GlypIcon;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CiluminacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista Tipo Iluminacion';
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Proyecto', 'url' => ['/dash/catproyecto/']];
$this->params['breadcrumbs'][] = 'Tipo Iluminacion';
?>
<div class="ciluminacion-model-index">

    <?php // $this->render('_search', ['model' => $searchModel,]) ?>

   
    <?php echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',],
            [   
                'class'=> 'kartik\grid\EditableColumn',
                'attribute'=>    'ctipo_iluminacion',

            ],
         
            ['class' =>  'yii\grid\ActionColumn',
                'template' => '{delete}',

            ],
        ],
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    'toolbar'=> [
        ['content'=>
            Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo',['create'], [ 'title'=> 'Nuevo Tipo de Iluminacion', 'class'=>'modalwin'])
        ],
        '{export}',
        '{toggleData}',
    ],
    'export'=>['fontAwesome'=>true],
    'bordered'=>true,
    'striped'=>true,
    'responsive'=>true,
    'hover'=>true,
     'panel'=>[
         'type'=>GridView::TYPE_DEFAULT,
         'heading'=>'<h1>'.$this->title.'</h1><br>'  , 
         'before'=> '<br><br>'.$this->render('_search', ['model' => $searchModel,]),
     ],
    'persistResize'=>false,
]); ?>



</div>
