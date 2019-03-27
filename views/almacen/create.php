<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Material */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-almacen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
