<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Llamada '.$model->fk_llamada, 'url' => ['/llamada/view?idllamada='.$model->fk_llamada]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cotizacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'escalas'=>$escalas,
    ]) ?>

</div>
