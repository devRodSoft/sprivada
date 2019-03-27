<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NivelComplejidadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de  Nivel de Complejidad";
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Proyecto', 'url' => ['/dash/catproyecto/']];
$this->params['breadcrumbs'][] = 'Nivel de Complejidad';
?>
<div class="nivel-complejidad-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>


   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],



            'gasto',
            [
                'attribute'=>'tiempo',
                'label'=>'Tiempo',
                'value'=>'cname'
            ],

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}{delete}',
            'buttons' => [
                   'update' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>' ,$url ,[  'title'=> 'Editar  Nivel de Complejidad', 'class'=>'modalwin']); 
                 },            
                    
               
              ],
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create'] , [ 'title'=> 'Nuevo Nivel de Complejidad', 'class'=>'modalwin']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
</div>
