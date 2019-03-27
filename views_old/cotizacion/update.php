<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

$this->title = 'Duplicar : '.$model->idcotizacion;

$this->params['breadcrumbs'][] = ['label' => 'Llamada '.$model->fk_llamada, 'url' => ['/llamada/view?idllamada='.$model->fk_llamada]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="cotizacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'escalas'=>$escalas,
    ]) ?>

</div>
