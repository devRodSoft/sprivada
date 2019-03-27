<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = 'Editar : '.$model->idcliente;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['/dash/catclientes']];
$this->params['breadcrumbs'][] = ['label' => 'Cliente', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Editar";
?>
<div class="cliente-update">

<?= $this->render('_form', [
       'model' => $model, ]) ?>

</div>
