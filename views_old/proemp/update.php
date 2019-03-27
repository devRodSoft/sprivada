<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoEmpleado */

$this->title = 'Editar : '.$model->idproyecto_empleado;

$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="proyecto-empleado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
