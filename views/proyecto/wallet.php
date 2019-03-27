<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="proyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>



   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ]],
              'codigo' , 
              'material',
              'familia',
              'costo',
            'cantidad',
        [   
            'attribute'=>'total',
            'value'=> 'ttotal',
        ],

            // ['class' => 'yii\grid\ActionColumn',
            // 'template' => '',
            //     'contentOptions' => ['width' => '120px;' , 'align' => 'center'],
            //     ],
        ],
    ]); ?>
</div>
