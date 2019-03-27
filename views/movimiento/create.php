<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Movimiento */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Entradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movimiento-create">
	
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,'almacenes'=>$almacenes,'lista'=> $lista,
    ]) ?>

</div>
