<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\CsubTipoGasto */

$this->title = "Mostrar : ".$model->idcsub_tipo_gasto;
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = 'Subtipo de Gasto';

$this->params['breadcrumbs'][] = "Mostrar : ".$model->idcsub_tipo_gasto;
?>
<div class="csub-tipo-gasto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo','glyphicon-plus', ['create'], ['class' => 'btn btn-success']) ?>

        <?= GlypIcon::aglyp('Editar','glyphicon-pencil', ['update', 'idcsub_tipo_gasto' => $model->idcsub_tipo_gasto, 'fk_ctipo_gasto' => $model->fk_ctipo_gasto], ['class' => 'btn btn-primary']) ?>

        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove', ['delete', 'idcsub_tipo_gasto' => $model->idcsub_tipo_gasto, 'fk_ctipo_gasto' => $model->fk_ctipo_gasto],[ 
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
            'idcsub_tipo_gasto',
            'csub_tipo_gasto',
            'fk_ctipo_gasto',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
