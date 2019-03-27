<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cotescala */

$this->title = 'Editar : '.$model->idcotescala;
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Cotescalas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="cotescala-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
