<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrdenCompra */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Egresos', 'url' => ['/dash/egresos/']];
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orden-compra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'productos'=> $productos,
    ]) ?>

</div>
