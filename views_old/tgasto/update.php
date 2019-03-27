<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CtipoGasto */

$this->title = 'Editar : '.$model->idctipo_gasto;

$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Gastos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="ctipo-gasto-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
