<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcalibreAcrilicoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista Calibre Acrilico';
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Proyecto', 'url' => ['/dash/catproyecto/']];
$this->params['breadcrumbs'][] = ['label' => 'Calibre Acrilico'];
?>
<div class="ccalibre-acrilico-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?= $this->render('_search', ['model' => $searchModel,]) ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn' ,
                'contentOptions' => ['width' => '50px;' ]],

//            'idccalibre_acrilico',
            'ccalibre_acrilico',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                 'update' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>' ,$url ,[  'title'=> 'Editar Calibre Acrilico', 'class'=>'modalwin']); 
                 },            
                    
               
              ],
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create'],[ 'title'=> 'Nuevo Calibre Acrilico', 'class'=>'modalwin']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],

    ]]); ?>


</div>
