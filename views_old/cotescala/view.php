<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\Cotescala */

$this->title = "Mostrar : ".$model->idcotescala;
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = "Mostrar : ".$model->idcotescala;
?>
<div class="cotescala-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo','glyphicon-plus', ['create'], ['class' => 'btn btn-success']) ?>

        <?= GlypIcon::aglyp('Editar','glyphicon-pencil', ['update', 'idcotescala' => $model->idcotescala, 'fk_cotizacion' => $model->fk_cotizacion], ['class' => 'btn btn-primary']) ?>

        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove', ['delete', 'idcotescala' => $model->idcotescala, 'fk_cotizacion' => $model->fk_cotizacion],[ 
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
            'idcotescala',
            'escala',
            'dimensiones',
            'precio',
            'fk_cotizacion',
        ],
    ]) ?>

</div>
