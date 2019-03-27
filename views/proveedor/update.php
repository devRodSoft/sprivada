<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */

$this->title = 'Editar : '.$model->idproveedor;

$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Proveedors', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="proveedor-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
