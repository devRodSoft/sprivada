<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\Empresa */

$this->title = "Mostrar : ".$model->idcliente;
$this->params['breadcrumbs'][] = ['label' => 'Cátalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['/cliente/']];

$this->params['breadcrumbs'][] = "Mostrar : ".$model->idcliente;
?>
<div class="cliente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo','glyphicon-plus', ['create'], ['class' => 'btn btn-success']) ?>

        <?= GlypIcon::aglyp('Editar','glyphicon-pencil', ['update', 'id' => $model->idcliente], ['class' => 'btn btn-primary']) ?>

        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove', ['delete', 'id' => $model->idcliente],[ 
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
            'idcliente',
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
            'tipo_cliente',
            'giro',
            'noempleados',
            'encargado_pago',
            'dias_pago',
            'contrato',
        ],
    ]) ?>

</div>
