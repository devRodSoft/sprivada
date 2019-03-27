<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CsubTipoGasto */

$this->title = 'Editar : '.$model->idcsub_tipo_gasto;

$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Subtipo de Gasto', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="csub-tipo-gasto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
