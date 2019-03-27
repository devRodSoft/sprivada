<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $searchModel app\search\ProyectoEmpleadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de  'Proyecto Empleados'";
$this->params['breadcrumbs'][] = ['label' => 'Proyecto', 'url' => ['proyecto/']];
$this->params['breadcrumbs'][] = 'Proyecto Empleados';
?>
<div class="proyecto-empleado-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],
            // 'fk_empleado',
             [  
                 'attribute' => 'fk_empleado',
                'value'=> 'fkEmpleado.alias',
                'header'=> 'Empleado',
           ],
            'porcentaje',
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}{delete}',
                            'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create'] , [ 'title'=> 'Nuevo Proyecto', 'class'=>'modalwin']) ,
                'contentOptions' => ['width' => '120px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
</div>
