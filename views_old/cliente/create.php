<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['/dash/catclientes']];
$this->params['breadcrumbs'][] = ['label' => 'Cliente', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
