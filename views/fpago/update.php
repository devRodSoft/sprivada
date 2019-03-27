<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CformaPago */

$this->title = 'Editar : '.$model->idcforma_pago;

$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Forma de Pago', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="cforma-pago-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
