<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\CformaPago */

$this->title = "Mostrar : ".$model->idcforma_pago;
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Forma de Pago', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Mostrar : ".$model->idcforma_pago;
?>
<div class="cforma-pago-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo','glyphicon-plus', ['create'], ['class' => 'btn btn-success']) ?>

        <?= GlypIcon::aglyp('Editar','glyphicon-pencil', ['update', 'id' => $model->idcforma_pago], ['class' => 'btn btn-primary']) ?>

        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove', ['delete', 'id' => $model->idcforma_pago],[ 
        'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Estas seguro de Eliminar?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcforma_pago',
            'cforma_pago',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
