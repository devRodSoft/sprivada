<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\Cestatus */

$this->title = "Mostrar : ".$model->idcestatus;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['/dash/proyectos']];
$this->params['breadcrumbs'][] = ['label' => 'Estatus', 'url' => ['index']];
 $this->params['breadcrumbs'][] = ['label' => 'Estatus', 'url' => ['index']]; $this->params['breadcrumbs'][] = "Mostrar : ".$model->idcestatus;
?>
<div class="cestatus-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo','glyphicon-plus', ,['create'], ['class' => 'btn btn-success']) ?>

        <?= GlypIcon::aglyp('Editar','glyphicon-pencil', ['update', 'id' => $model->idcestatus], ['class' => 'btn btn-primary']) ?>

        <?= GlypIcon::aglyp('Editar','glyphicon-pencil', ['delete', 'id' => $model->idcestatus], [
        'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Estas seguro de Eliminar?',
                'method' => 'post',
            ],
        ]        ) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcestatus',
            'cestatus',
        ],
    ]) ?>

</div>
