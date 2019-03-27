<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\Um */

$this->title = "Mostrar : ".$model->idum;
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = 'Ums';

$this->params['breadcrumbs'][] = "Mostrar : ".$model->idum;
?>
<div class="um-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo','glyphicon-plus', ['create'], ['class' => 'btn btn-success']) ?>

        <?= GlypIcon::aglyp('Editar','glyphicon-pencil', ['update', 'id' => $model->idum], ['class' => 'btn btn-primary']) ?>

        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove', ['delete', 'id' => $model->idum],[ 
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
            'idum',
            'um',
        ],
    ]) ?>

</div>
