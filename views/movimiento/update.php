<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Movimiento */

$this->title = 'Editar : '.$model->idmovimiento;

$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Movimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="movimiento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
