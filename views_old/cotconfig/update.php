<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cotconfig */

$this->title = 'Editar : '.$model->idcotconfig;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['/dash/proyectos/']];
$this->params['breadcrumbs'][] = ['label' => 'Configuracion', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="cotconfig-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
