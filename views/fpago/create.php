<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CformaPago */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Forma de Pago', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cforma-pago-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
