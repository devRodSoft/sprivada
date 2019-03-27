<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CajaChica */

$this->title = 'Editar : '.$model->idcaja_chica;
$this->params['breadcrumbs'][] = ['label' => 'Egresos', 'url' => ['/dash/egresos/']];
$this->params['breadcrumbs'][] = ['label' => 'Indirectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="caja-chica-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
