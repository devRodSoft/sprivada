<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Proveedors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedor-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
