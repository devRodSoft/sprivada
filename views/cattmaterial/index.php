<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\custom\GlypIcon;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CtmaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Tipo de Materiales';
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Proyecto', 'url' => ['/dash/catproyecto/']];
$this->params['breadcrumbs'][] = "Tipo Material";
?>
<div class="ctmaterial-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= $this->render('_search', ['model' => $searchModel,]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',

                'contentOptions' => ['width' => '50px;' ]],

            'ctipo_material',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                   'update' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>' ,$url ,[  'title'=> 'Editar Tipo de Material', 'class'=>'modalwin']); 
                 },            
                    
               
              ],
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create'],[ 'title'=> 'Nuevo Tipo de Material', 'class'=>'modalwin']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
            ],
        ],
    ]); ?>

</div>
