<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\Elemento */

$this->title = "Mostrar : ".$model->idelemento;
$this->params['breadcrumbs'][] = ['label' => 'Cátalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Elementos', 'url' => ['index']];

$this->params['breadcrumbs'][] = "Mostrar : ".$model->idelemento;
?>
<div class="elemento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo','glyphicon-plus', ['create'], ['class' => 'btn btn-success']) ?>

        <?= GlypIcon::aglyp('Editar','glyphicon-pencil', ['update', 'idelemento' => $model->idelemento, 'fkservicio' => $model->fkservicio, 'fkpuesto' => $model->fkpuesto], ['class' => 'btn btn-primary']) ?>

        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove', ['delete', 'idelemento' => $model->idelemento, 'fkservicio' => $model->fkservicio, 'fkpuesto' => $model->fkpuesto],[ 
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
            'idelemento',
            'paterno',
            'materno',
            'nombre',
            'iniciales',
            'sexo',
            'fkservicio',
            'fkpuesto',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
