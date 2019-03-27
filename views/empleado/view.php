<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\Empleado */

$this->title = "Mostrar : ".$model->idempleado;
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = 'Empleados';

$this->params['breadcrumbs'][] = "Mostrar : ".$model->idempleado;
?>
<div class="empleado-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo','glyphicon-plus', ['create'], ['class' => 'btn btn-success']) ?>

        <?= GlypIcon::aglyp('Editar','glyphicon-pencil', ['update', 'idempleado' => $model->idempleado, 'fk_categoria' => $model->fk_categoria], ['class' => 'btn btn-primary']) ?>

        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove', ['delete', 'idempleado' => $model->idempleado, 'fk_categoria' => $model->fk_categoria],[ 
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
            'idempleado',
            'alias',
            'nombre',
            'apellido',
            'imss',
            'domicilio',
            'telefono',
            'foto_ruta',
            'fk_categoria',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
