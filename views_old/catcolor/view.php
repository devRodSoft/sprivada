<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\CtipoColor */

$this->title = "Mostrar : ".$model->cidtipo_color;
$this->render("_menu.php");
?>
<div class="ctipo-color-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo', 'glyphicon-plus' ,  ['create'], ['class' => 'btn btn-success']) ?>
        <?= GlypIcon::aglyp('Editar', 'glyphicon-pencil' ,['update', 'id' => $model->cidtipo_color], ['class' => 'btn btn-primary']) ?>
        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove' , ['delete', 'id' => $model->cidtipo_color], [
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
            'cidtipo_color',
            'ctipo_color',
        ],
    ]) ?>

</div>
