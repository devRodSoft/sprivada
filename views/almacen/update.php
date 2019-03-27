<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Material */

$this->title = 'Editar : '.$model->idmaterial_almacen;

$this->params['breadcrumbs'][] = ['label' => 'Inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="material-almacen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
