<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $searchModel app\search\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de Clientes";
$this->params['breadcrumbs'][] = ['label' => 'Cátalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = 'Clientes';
?>
<div class="cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            'idcliente',
            'nombre',
            'rfc',
            'direccion',
            'noexterior',
            'nointerior',
            ['attribute'=>'fkmunicipio',
             'value'=>'fkmunicipio0.descripcion'],
             ['attribute'=>'fkestado',
             'value'=>'fkestado0.descripcion'],
            // 'colonia',
            // 'cp',
            // 'calle',
            // 'calle2',
            // 'telefono',
            // 'celular',
            // 'fkestado',
            // 'ciudad',
            // 'tipo_cliente',
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
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
</div>
