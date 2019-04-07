<?php

use yii\helpers\Html;
use yii\helpers\Url;;
use yii\grid\GridView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $searchModel app\search\EmpresaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de Empresas";
$this->params['breadcrumbs'][] = ['label' => 'Cátalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = 'Empresas';
?>
<div class="empresa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            'idempresa',
            'razon',
            'nombre',
            'rfc',
            'direccion',
            // 'nointerior',
            // 'colonia',
            // 'noexterior',
            // 'cp',
            // 'calle',
            // 'calle2',
            // 'telefono',
            // 'celular',
            // 'ciudad',
            // 'municipio',
            // 'estado',
            // 'tipo_empresa',
            // 'giro',
            // 'noempleados',
            // 'encargado_pago',
            // 'dias_pago',
            // 'contrato',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => [
                'view' => function ($url, $model) {
                    $url1 = Url::to(['view', 'id'=> $model->idempresa]);
                     return Html::a('<i class="glyphicon glyphicon-eye-open"></i>' ,$url1 ); 
                 },
                'update' => function ($url, $model) {
                   $url1 = Url::to(['update', 'id'=> $model->idempresa]);
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>' ,$url1 ); 
                },
                'delete' => function($url,$model){
                   $url1 = 'delete?id='.$model->idempresa;
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', [$url1] ,[ 'title'=>'Delete', 'aria-label'=>'Delete' ,'data-confirm'=>'Are you sure you want to delete this item?', 'data-method'=>'post' ,'data-pjax'=>'0' ]);
                }
              ],
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
</div>
