<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Salidas Proyectos";

$this->params['breadcrumbs'][] = 'Salidas Proyectos';
?>
<div class="proyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>



   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            'idproyecto',
            'proyecto',
            'escala',
            'fecha_entrega',
           //  ['attribute'=>'precio',
           //    'format'=>['decimal',2]],
           //   ['attribute'=>'costo',
           //     'format'=>['decimal',2],
           //  ],
           //   [  
           //       'attribute' => 'fk_cliente',
           //      'value'=> 'fkCliente.nombre_razon_social',
           //      'header'=> 'Cliente',
           // ],
           
           //   [  
           //       'attribute' => 'complejidad',
           //      'value'=>'fkNivelComplejidad.cname',
           //      'header'=> 'N. Complejidad',
           // ],
                'fkCestatus.cestatus',
            // 'fk_ctipo_material',
            // 'fk_ctipo_color',
            // 'fk_ctipo_iluminacion',
            // 'fk_ccalibre_acrilico',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{create}',
            'buttons' => [
                  'create' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon glyphicon-shopping-cart"></i>' ,$url ,[  'title'=> 'Costo Proyecto']); 
                 },           
                    
               
              ],
                //             'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create'] , [ 'title'=> 'Nuevo Proyecto', 'class'=>'modalwin']) ,
                // 'contentOptions' => ['width' => '120px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
</div>
