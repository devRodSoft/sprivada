<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\Almacen */

$this->title = "Mostrar : ".$model->idalmacen;
$this->params['breadcrumbs'][] = ['label' => 'Cátalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Almacenes', 'url' => ['index']];

$this->params['breadcrumbs'][] = "Mostrar : ".$model->idalmacen;
?>
<div class="almacen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo','glyphicon-plus', ['create'], ['class' => 'btn btn-success']) ?>

        <?= GlypIcon::aglyp('Editar','glyphicon-pencil', ['update', 'idalmacen' => $model->idalmacen, 'fkgrupo' => $model->fkgrupo, 'fktipo' => $model->fktipo, 'fkclase' => $model->fkclase], ['class' => 'btn btn-primary']) ?>

        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove', ['delete', 'idalmacen' => $model->idalmacen, 'fkgrupo' => $model->fkgrupo, 'fktipo' => $model->fktipo, 'fkclase' => $model->fkclase],[ 
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
            'idalmacen',
            'descripcion',
            'fkgrupo',
            'fktipo',
            'fkclase',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
