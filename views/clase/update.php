<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Clase */

$this->title = 'Editar : '.$model->idclase;

$this->params['breadcrumbs'][] = ['label' => 'Cátalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Clases', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="clase-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
