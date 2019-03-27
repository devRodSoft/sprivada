<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoEmpleado */

$this->title = "Mostrar : ".$model->idproyecto_empleado;
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = 'Proyecto Empleados';

$this->params['breadcrumbs'][] = "Mostrar : ".$model->idproyecto_empleado;
?>
<div class="proyecto-empleado-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo','glyphicon-plus', ['create'], ['class' => 'btn btn-success']) ?>

        <?= GlypIcon::aglyp('Editar','glyphicon-pencil', ['update', 'idproyecto_empleado' => $model->idproyecto_empleado, 'fk_proyecto' => $model->fk_proyecto, 'fk_empleado' => $model->fk_empleado], ['class' => 'btn btn-primary']) ?>

        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove', ['delete', 'idproyecto_empleado' => $model->idproyecto_empleado, 'fk_proyecto' => $model->fk_proyecto, 'fk_empleado' => $model->fk_empleado],[ 
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
            'idproyecto_empleado',
            'porcentaje',
            'fk_proyecto',
            'fk_empleado',
        ],
    ]) ?>

</div>
