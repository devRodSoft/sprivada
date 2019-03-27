<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empleado */

$this->title = 'Editar : '.$model->idempleado;

$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="empleado-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
