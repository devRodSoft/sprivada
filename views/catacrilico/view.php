<?php

use app\custom\GlypIcon;
use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcalibreAcrilicoModel */

$this->title = "Mostrar : ".$model->idccalibre_acrilico;
$this->render("_menu.php");
?>
<div class="ccalibre-acrilico-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo', 'glyphicon-plus' ,  ['create'], ['class' => 'btn btn-success']) ?>
        <?= GlypIcon::aglyp('Editar', 'glyphicon-pencil' ,['update', 'id' => $model->idccalibre_acrilico], ['class' => 'btn btn-primary']) ?>
        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove' , ['delete', 'id' => $model->idccalibre_acrilico], [
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
            'idccalibre_acrilico',
            'ccalibre_acrilico',
        ],
    ]) ?>

</div>
