<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Empleado */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empleado-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
