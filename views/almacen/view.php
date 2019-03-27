<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\Material */

$this->title = "Mostrar : ".$model->idmaterial_almacen;
$this->params['breadcrumbs'][] = ['label' => 'Materiales', 'url' => ['index']];

$this->params['breadcrumbs'][] = "Mostrar : ".$model->idmaterial_almacen;
?>
<div class="material-almacen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo','glyphicon-plus', ['create'], ['class' => 'btn btn-success']) ?>

        <?= GlypIcon::aglyp('Editar','glyphicon-pencil', ['update', 'id' => $model->idmaterial_almacen], ['class' => 'btn btn-primary']) ?>

        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove', ['delete', 'id' => $model->idmaterial_almacen],[ 
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
            'idmaterial_almacen',
            'material_almacen',
            'costo',
            'costo_iva',
            'familia',
            'existencia',
            'codigo',
            'created_at',
            'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

</div>
