<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CentroCosto */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Centro Costos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centro-costo-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
