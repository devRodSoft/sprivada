<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $searchModel app\search\EmpleadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de Empleados";
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Empleados', 'url' => ['/dash/catempleado/']];
$this->params['breadcrumbs'][] = 'Empleados';
?>
<div class="empleado-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            // 'idempleado',
            'alias',
            'nombre',
            'apellido',
            'imss',
            // 'domicilio',
            'telefono',
            // 'foto_ruta',
            // 'fk_categoria',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn',
           'template' => '{update}{delete}',
             'buttons' => [
                 'update' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>' ,$url ,[  'title'=> 'Editar Empleado', 'class'=>'modalwin']); 
                 },
                 ],         
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create'],[ 'title'=> 'Nuevo Empleado', 'class'=>'modalwin']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
</div>
