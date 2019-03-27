
<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MediocontactoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista Medio Contacto';
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Cliente', 'url' => ['/dash/catcliente/']];
$this->params['breadcrumbs'][] = "Medio Contacto";
?>
<div class="mediocontacto-model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search', ['model' => $searchModel,]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',

                'contentOptions' => ['width' => '50px;' ]],

            // 'idmediocontacto',
            'medio',

             ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                 'update' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>' ,$url ,[  'title'=> 'Editar Medio de Contacto', 'class'=>'modalwin']); 
                 },            
                    
               
              ],
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create'],[ 'title'=> 'Nuevo Medio de Contacto', 'class'=>'modalwin']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center' , 'title'=>'Nuevo Medio de Contacto'],
            ],
        ],
    ]); ?>

</div>
