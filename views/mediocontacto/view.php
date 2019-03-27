<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\Mediocontacto */

$this->title = "Mostrar : ".$model->idmediocontacto;
$this->render("_menu");
?>
<div class="mediocontacto-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo', 'glyphicon-plus' ,  ['create'], ['class' => 'btn btn-success']) ?>
        <?= GlypIcon::aglyp('Editar', 'glyphicon-pencil' ,['update', 'id' => $model->idmediocontacto], ['class' => 'btn btn-primary']) ?>
        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove' , ['delete', 'id' => $model->idmediocontacto], [
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
            'idmediocontacto',
            'medio',
        ],
    ]) ?>

</div>
