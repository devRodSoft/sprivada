<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CentroCostoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de  Centro Costos";
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/catindirecta/']];
$this->params['breadcrumbs'][] = 'Centro Costos';
?>
<div class="centro-costo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>


   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            'nombre_centro',
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}{delete}',

                'buttons' => [
                 'update' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>' ,$url ,[  'title'=> 'Editar Centro de Costo', 'class'=>'modalwin']); 
                 },
                 ],           

                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create'],['title'=> 'Nuevo Centro de Costo', 'class'=>'modalwin']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
</div>
