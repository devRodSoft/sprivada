<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SucursalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de Sucursales";
$this->params['breadcrumbs'][] = ['label' => 'Cátalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = 'Sucursales';
?>
<div class="sucursal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            'idsucursal',
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
            // 'tipo_sucursal',
            // 'giro',
            // 'noempleados',
            // 'encargado',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{update}{delete}',
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
</div>
