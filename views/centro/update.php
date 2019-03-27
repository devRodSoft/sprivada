<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CentroCosto */

$this->title = 'Editar : '.$model->idcentro_costo;
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Centro Costos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="centro-costo-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

