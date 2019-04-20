<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Almacen */

$this->title = 'Editar : '.$model->idalmacen;

$this->params['breadcrumbs'][] = ['label' => 'Cátalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Almacenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="almacen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
