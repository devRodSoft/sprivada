<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cestatus */

$this->title = 'Editar : '.$model->idcestatus;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['/dash/proyectos']];
$this->params['breadcrumbs'][] = ['label' => 'Estatus', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="cestatus-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
