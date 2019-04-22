<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Elemento */

$this->title = 'Editar : '.$model->idelemento;

$this->params['breadcrumbs'][] = ['label' => 'Cátalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Elementos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="elemento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
