<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CotescalaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de  'Cotescalas'";
$this->params['breadcrumbs'][] = 'Cotescalas';
?>
<div class="cotescala-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            'idcotescala',
            'escala',
            'dimensiones',
            'precio',
            'fk_cotizacion',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}{delete}',
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
</div>
