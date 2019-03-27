<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CtipoGasto */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Gastos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctipo-gasto-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
