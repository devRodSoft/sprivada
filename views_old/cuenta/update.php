<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CuentaPagar */

$this->title = 'Editar : '.$model->idcuenta_pagar;

$this->params['breadcrumbs'][] = ['label' => 'Cuentas Pendientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="cuenta-pagar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
