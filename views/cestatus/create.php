<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cestatus */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['/dash/proyectos']];
$this->params['breadcrumbs'][] = ['label' => 'Estatus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cestatus-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
