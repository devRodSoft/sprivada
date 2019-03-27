<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProyectoEmpleado */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-empleado-create">

    <?= $this->render('_form', [
        'model' => $model,
        'empleados'=>$empleados,
    ]) ?>

</div>
