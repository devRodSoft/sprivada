<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\CuentaPagar */

$this->title = "Mostrar : ".$model->idcuenta_pagar;
$this->params['breadcrumbs'][] = ['label' => 'Cuentas Pendientes', 'url' => ['/cuenta/']];
$this->params['breadcrumbs'][] = "Mostrar : ".$model->idcuenta_pagar;
?>
<div class="cuenta-pagar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcuenta_pagar',
            'folio_dcto',
            'tipo_dcto',
            'fecha_dcto',
            'deuda',
            'pagado',
            'st_pagado',
            'fk_metodo_pago',
            'fk_proveedor',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
