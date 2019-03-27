<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CtipoColorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista Tipo Color';
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Proyecto', 'url' => ['/dash/catproyecto/']];
$this->params['breadcrumbs'][] = ['label' => 'Tipo Color'];

?>
<div class="ctipo-color-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel,]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'contentOptions' => ['width' => '50px;' ]],

//            'cidtipo_color',
            'ctipo_color',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                 'update' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>' ,$url ,[  'title'=> 'Editar Tipo de Color', 'class'=>'modalwin']); 
                 },            
                    
               
              ],
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create'],[ 'title'=> 'Nuevo Tipo de Color', 'class'=>'modalwin']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center' , 'title'=>'Nuevo Tipo de Color'],
            ],
        ],
    ]); ?>

</div>
