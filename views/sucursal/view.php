<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\Sucursal */

$this->title = "Mostrar : ".$model->idsucursal;
$this->params['breadcrumbs'][] = ['label' => 'Cátalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Sucursales', 'url' => ['index']];

$this->params['breadcrumbs'][] = "Mostrar : ".$model->idsucursal;
?>
<div class="sucursal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo','glyphicon-plus', ['create'], ['class' => 'btn btn-success']) ?>

        <?= GlypIcon::aglyp('Editar','glyphicon-pencil', ['update', 'idsucursal' => $model->idsucursal, 'fkmunicipio' => $model->fkmunicipio, 'fkestado' => $model->fkestado], ['class' => 'btn btn-primary']) ?>

        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove', ['delete', 'idsucursal' => $model->idsucursal, 'fkmunicipio' => $model->fkmunicipio, 'fkestado' => $model->fkestado],[ 
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
            'idsucursal',
            'razon',
            'nombre',
            'rfc',
            'direccion',
            'nointerior',
            'colonia',
            'noexterior',
            'cp',
            'calle',
            'calle2',
            'telefono',
            'celular',
            'ciudad',
            'fkmunicipio',
            'fkestado',
            'tipo_sucursal',
            'giro',
            'noempleados',
            'encargado',
        ],
    ]) ?>

</div>
