<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $searchModel app\search\ProveedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de Proveedores";
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = 'Proveedores';
?>
<div class="proveedor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            // 'idproveedor',
            'razon_social',
            'nombre_contacto',
            'telefono1',
            'telefono',
            'rfc',
            'direccion',
            // 'email:email',
            // 'ciudad',
            // 'estado',
            // 'pagina_web',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}{delete}',
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create'] ,[ 'title'=> 'Nuevo Proveedor', 'class'=>'modalwin']) ,
                'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>' ,$url ,[  'title'=> 'Mostrar Proveedor', 'class'=>'modalwin']); 
                 },
                 'update' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>' ,$url ,[  'title'=> 'Editar Proveedor', 'class'=>'modalwin']); 
                 },            
                    
               
              ],
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
</div>
