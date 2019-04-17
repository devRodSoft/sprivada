<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Puesto */

$this->title = 'Editar : '.$model->idpuesto;

$this->params['breadcrumbs'][] = ['label' => 'Cátalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Puestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="puesto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
