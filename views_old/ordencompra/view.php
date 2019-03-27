<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\OrdenCompra */

$this->title = "Mostrar : ".$model->id_orden_compra;
$this->params['breadcrumbs'][] = ['label' => 'Egresos', 'url' => ['/dash/egresos/']];
$this->params['breadcrumbs'][] = ['label' => 'Orden Compras', 'url' => ['index']];

$this->params['breadcrumbs'][] = "Mostrar : ".$model->id_orden_compra;
?>
<div class="orden-compra-view">

    <h1><?= Html::encode($this->title) ?></h1>

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_orden_compra',
            'folio',
            'fecha_compra:datetime',
            'fecha_recepcion:datetime',
            'observacion',
            'solicitante',
            'utilizacion',
            'fkProveedor.razon_social'
        ],
    ]) ?>

    <h1>Productos:</h1>
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],
                'codigo',
                'descripcion',
                'cantidad:datetime',
                'um',
                          

        ],
    ]); ?>

</div>
