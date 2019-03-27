<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\Ctmaterial */

$this->title = "Ver : ".$model->idctipo_material;
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Tipo Material', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Ver";
?>
<div class="ctmaterial-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo', 'glyphicon-plus' ,  ['create'], ['class' => 'btn btn-success']) ?>
        <?= GlypIcon::aglyp('Editar', 'glyphicon-pencil' ,['update', 'id' => $model->idctipo_material], ['class' => 'btn btn-primary']) ?>
        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove' , ['delete', 'id' => $model->idctipo_material], [
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
            'idctipo_material',
            'ctipo_material',
        ],
    ]) ?>

</div>
