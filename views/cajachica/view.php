<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\CajaChica */

$this->title = "Mostrar : ".$model->idcaja_chica;
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = 'Caja Chicas';

$this->params['breadcrumbs'][] = "Mostrar : ".$model->idcaja_chica;
?>
<div class="caja-chica-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo','glyphicon-plus', ['create'], ['class' => 'btn btn-success']) ?>

        <?= GlypIcon::aglyp('Editar','glyphicon-pencil', ['update', 'idcaja_chica' => $model->idcaja_chica, 'fk_cforma_pago' => $model->fk_cforma_pago, 'fk_csub_tipo_gasto' => $model->fk_csub_tipo_gasto, 'fk_centro_costo' => $model->fk_centro_costo], ['class' => 'btn btn-primary']) ?>

        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove', ['delete', 'idcaja_chica' => $model->idcaja_chica, 'fk_cforma_pago' => $model->fk_cforma_pago, 'fk_csub_tipo_gasto' => $model->fk_csub_tipo_gasto, 'fk_centro_costo' => $model->fk_centro_costo],[ 
        'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Estas seguro de Eliminar?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcaja_chica',
            'fecha_comprachica',
            'observacion',
            'importe',
            'fk_cforma_pago',
            'fk_csub_tipo_gasto',
            'fk_centro_costo',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'caja_chica',
        ],
    ]) ?>

</div>
