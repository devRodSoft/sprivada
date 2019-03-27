<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrdenCompra */

$this->title = 'Editar : '.$model->id_orden_compra;

$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Orden Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="orden-compra-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
